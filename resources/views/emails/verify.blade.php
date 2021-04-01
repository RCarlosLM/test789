<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            background-color: #e9ecef;
            font-family: 'Montserrat', sans-serif;
        }
        div.panel {
            padding: 3rem;
        }
        div.line {
            background-color: #be0411;
            height: 1rem;
            width: 100%;
            position: absolute;
        }
        div.line2 {
            position: relative;
            background-color: #212529;
            height: 1rem;
            width: 30%;
            z-index: 2;
            margin: 0 auto;
        }
        div.logo {
            background-position: center;
            background-repeat: no-repeat;
            height: 10rem;
            width: 50rem;
            background-size: contain;
            margin: 0 auto;
            background-image: url({{ asset('img/Logo/Logo-Negro.png') }});
        }

        h1 {
            text-align: center;
            color: #be0411;
            letter-spacing: 4px;
            font-weight: 500;
            margin-top: 3rem;
        }
        h2 {
            text-align: center;
            color: #939598;
            font-size: 2.25rem;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }
        h3 {
            color: #212529;
            text-align: center;
            font-size: 1.675rem;
            line-height: 1.24;
            font-weight: 600;
            margin: 0;
        }
        a {
            display: block;
            text-align: center;
            padding-top: 2rem;
            width: 50%;
            margin: 0 auto;
        }
        div.footer {
            background-color: #be0411;
            height: 8rem;
            position: relative;
        }
        div.logo-footer {
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            height: 10rem;
            width: 23rem;
            position: absolute;
            right: 1rem;
            bottom: 0.5rem;
            background-image: url({{ asset('img/Logo/Logo-Negro.png') }});
        }
    </style>
</head>
<body>
    <div class="line">
        <div class="line2"></div>
    </div>
    <div class="panel">
        <div class="logo"></div>
        <h1>CONFIRMACIÓN DE CUENTA</h1>
        <h2>¡Ya casi estás listo!</h2>
        <h3>Haz click en el siguiente enlace</h3>
        <a href="{{ $url }}" target="_blank">{{ $url }}</a>
    </div>
    <div class="footer">
        <div class="logo-footer"></div>
    </div>
</body>
</html>
