@extends('layouts.app')
@section('content')

    <verificado    :guest="{{ json_encode(auth()->guest()) }}"
                :auth="{{ json_encode(auth()->user()) }}">
    </verificado>
    
@endsection