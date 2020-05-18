<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/logos/ico2.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('accion')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a href="{{ route('raiz') }}">
                    <img src="{{ asset('img/logos/logo4.png') }}" class="img-fluid" width="155">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav ml-auto">               
                        <li class="nav-item @yield('activeProducts')">
                            <a class="nav-link" href="{{ route('products.index') }}">Regresar a la tienda</a>
                        </li>                                    
                    </ul>
                </div>
            </nav>
    </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
