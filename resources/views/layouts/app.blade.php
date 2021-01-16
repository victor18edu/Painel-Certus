<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2f204339a4.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    :root {
        --cor-logo-primary: #2170b2;
        --cor-primary-low-opacity: rgba(121, 145, 165, 0.377);

        --cor-logo-secundary: #c70023;
        --cor-background-page: #eeeeee;
        --cor-gradient: linear-gradient(to right, #c70023, #2170b2);
    }

    .container-center {
        height: 80vh;
        width: 100vw;
        /* background-color:var(--cor-background-page);*/
        font-family: 'Poppins', sans-serif;
        overflow: hidden;
    }

    .form-login {
        height: 340px;
        width: 95%;
        min-width: 280px;
        max-width: 450px;
        padding: 1%;

        border-radius: 10px;
        background-color: white;

        box-shadow: 2px 2px 15px 2px var(--cor-primary-low-opacity);
        -webkit-box-shadow: 2px 2px 15px 2px var(--cor-primary-low-opacity);

    }

    .form-login .title-login {
        width: 100%;
        height: 80px;
    }

    .form-login .title-login h3 {
        font-size: 16px;
        text-align: center;
        padding: 2%;
        border-bottom: 1px solid var(--cor-primary-low-opacity);
    }

    .form-login .title-login .logo {
        background: url(imgs/logo1.png) no-repeat;
        background-size: contain;
        width: 180px;
        height: 50px;
        margin: 0;
    }

    #form-login {
        width: 100%;

    }

    #icon-login {
        color: var(--cor-logo-primary);
        background-color: var(--cor-primary-low-opacity);
        font-size: 35px;
        padding: 5px;
        border-right: transparent;
        border-top-right-radius: 0px;
        border-top-left-radius: 5px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 5px;
        border-left: 2px solid var(--cor-primary-low-opacity);
        border-bottom: 2px solid var(--cor-primary-low-opacity);
        border-top: 2px solid var(--cor-primary-low-opacity);

    }

    .form-login .form-group input {
        height: 30px;
        background-color: white !important;
        display: block;
        width: 100%;
        height: 35px;
        border: none;
        border-radius: 5px;
        border: 2px solid var(--cor-primary-low-opacity);
        transition: all 1s;
        max-width: 310px;

        border-top-left-radius: 0px;
        border-top-right-radius: 5px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 5px;
        border-left: 2px solid var(--cor-primary-low-opacity);
        border-bottom: 2px solid var(--cor-primary-low-opacity);
        border-top: 2px solid var(--cor-primary-low-opacity);
    }

    .form-login .form-group input:focus {
        outline: none;
        box-shadow: 0 0 0 0;
        outline: 0;
        background-color: transparent !important;
    }

    #form-login label {
        margin-left: 0px;
        bottom: 28px;
        transition: transform .2s ease-in-out;
        font-weight: 700;
        width: 90%;
    }

    .form-login .form-group label span {
        color: var(--cor-logo-secundary);
    }

    .form-login .btn-entrar {
        color: white !important;
        background-color: var(--cor-logo-primary) !important;
        font-weight: 700;
        letter-spacing: 2px;
        font-size: 18px;
        text-transform: uppercase;
        border: none;
        outline: none;
        height: 40px;
        width: 90%;
        max-width: 350px;

        margin-left: 15px;
    }

    @media (min-width: 450px) {
        #form-login label {
            margin-left: 29px;
        }

        .form-login .btn-entrar {
            margin-left: 45px;
        }
    }

    @media (min-width: 1000px) {
        #form-login label {
            margin-left: 25px;
        }

        .form-login .btn-entrar {
            margin-left: 35px;
        }
    }
    </style>

</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>