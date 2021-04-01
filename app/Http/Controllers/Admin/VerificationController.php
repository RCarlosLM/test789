<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use App\Http\Resources\User as UserResource;
use App\User;
use Auth;
use Carbon\Carbon;
use App\Notifications\UserRegister;
use Illuminate\Support\Facades\Storage;

class VerificationController extends BaseController
{
    use VerifiesEmails;

    /**
     * Mark the authenticated user’s email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function verify(Request $request) {
        $requestData = $request->all();
        $user = User::findOrFail($requestData['user']);
        $date = date('Y-m-d g:i:s');
        $user->email_verified_at = $date;
        $user->save();

        return $this->sendResponse(new UserResource($user), '¡Cuenta Verificada!');
    }

    /**
     * Resend the email verification notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * */
    public function resend(Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('User already have verified email!', 422);
        }

        $request->user()->sendEmailVerificationNotification();
        return response()->json('The notification has been resubmitted');
    }

    // Registro de usuario
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->sendApiEmailVerificationNotification();
        $user->notify(new UserRegister($user));

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    // Inicio de sesión y creación de token
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    // Cierre de sesión (anular el token)
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    // Obtener el usuario
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    //guardar archivo
    public function filesave()
    {
        $date = Carbon::now();
        // verificamos si el archivo con el nombre ya existe
        if(Storage::exists('files/' . 'file-' . $date->second . '.txt'))
            return response()->json([
                'filename' => 'El archivo ya existe',
            ]);
        Storage::put('files/' . 'file-' . $date->second . '.txt', request()->data);
        return response()->json([
            'filename' => 'files/' . 'file-' . $date->second . '.txt',
        ]);
    }

}


