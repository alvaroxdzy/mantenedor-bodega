<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> Ingenieria Javier Cortes </title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style type="text/css">

        </style>


        <!-- Head -->

    </head>
    <body id="cuepo_base">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container" id="app">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="{{ asset('/img/logo.PNG')}}" style="width:150px;" />    

                    </a>
                    <ul class="nav justify-content-end" id="ul_layout">

                      <li id="li_layout" class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle font-small"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" href="/bodegas">Movimiento Producto </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/home"> Entrada productos </a> 
                            <a class="dropdown-item" href="/home"> Salida productos </a> 
                        </div>

                        <li id="li_layout" class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle font-small"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" href="/bodegas"> Inventario  </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/busqueda-bodegas"> Bodegas </a> 
                            <a class="dropdown-item" href="/home"> Productos </a> 
                        </div>

                        <li id="li_layout"><a class="nav-link" id="linkLayout" href="contact">Contact</a></li>
                        <li id="li_layout"><a class="nav-link" id="linkLayout" href="about">About</a></li>                     
                    </ul>


                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto" id="ul_layout">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto" id="ul_layout">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li id="li_layout" class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li id="li_layout" class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li id="li_layout" class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

<footer class="page-footer font-small blue">
    <div class="pie">
      <p><strong>Santiago:</strong> Lincoyan 9780, Quilicura, Santiago, Chile  / <strong>Tel&eacute;fono: </strong>(+56 2) 27207900 / <strong>Fax:</strong> (+56 2) 2720 79 50 / <strong>transportes@javiercortes.com</strong></p>
      <p><strong>Antofagasta:</strong> Acantitita 425, Sector La Chimba, Antofagasta, Chile  / <strong>Tel&eacute;fono: </strong>(+56 2) 552552100 /<strong> Fax:</strong> (5655) 211012</p>
  </div>
  <div class="clear"></div>
</footer>

</html>

