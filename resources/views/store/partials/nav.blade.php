<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <img src="{{ asset('img/locales/logo3.png') }}" class="img-fluid" width="155">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @yield('activeInicio')">
                    <a class="nav-link" href="{{ route('store.index') }}">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @yield('activeProducts')">
                    <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
                </li>
                <li class="nav-item @yield('activeQs')">
                    <a class="nav-link" href="#">¿Quienes somos?</a>
                </li>
                <li class="nav-item @yield('activeContact')">
                    <a class="nav-link" href="#">Contactanos</a>
                </li>
            @guest                    
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Acceder</a>
                </li>
            @else
                <li class="nav-item @yield('activeUser') dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a  href="cart.html">
                        <i class="fas fa-shopping-cart text-white  mr-2 fa-3x"></i>
                    </a>
                </li>
            @endguest  
            </ul>
        </div>
    </nav>
</header>
<main>