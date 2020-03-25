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
                <li class="nav-item @yield('activeInicio')">
                    <a class="nav-link" href="{{ route('store.index') }}">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @yield('activeProducts')">
                    <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
                </li>
                <li class="nav-item @yield('activeMedia')">
                    <a class="nav-link" href="{{ route('store.media') }}">Videoteca</a>
                </li>
                <li class="nav-item @yield('activeQs')">
                    <a class="nav-link" href="{{ route('store.company') }}">¿Quienes somos?</a>
                </li>
                <li class="nav-item @yield('activeContact')">
                    <a class="nav-link" href="{{ route('store.contact') }}">Contactanos</a>
                </li>
            @guest                    
                <li class="nav-item">
                     <a class="nav-link" href="" data-toggle="modal" data-target="#loginModal"> Acceder</a>
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
                    <a  href="{{ route('cart') }}">
                        <i class="fas fa-shopping-cart text-white  mr-2 fa-3x"></i>
                    </a>
                </li>
            @endguest  
            </ul>
        </div>
    </nav>
</header>
<main>
    {{-- login modal --}}
    <div class="modal fade login" tabindex="-1" id="loginModal" role="dialog">
          <div class="modal-dialog modal-sm">
              <div class="modal-content">
                 <div class="modal-header bg-dark">
                  <h4 class="modal-title text-white">Acceso</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                        
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">                              
                                <div class="form loginBox">
                                    <form id="formLogin" method="POST" action="{{ route('login') }}">
                                    @csrf
                                        <div class="form-group row">
                                            <label for="email" class="col-md-3 col-form-label text-md-right">Correo:</label>
                                            <div class="col-md-9">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-3 col-form-label text-md-right">Clave:</label>

                                            <div class="col-md-9">
                                                <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 ">
                                                <button id="btnLogin" type="button" class="btn btn-warning btn-block">
                                                    {{ __('Login') }}
                                                </button>
                                               {{--  @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                                <div class="form">
                                    <form id="formRegistrar" method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="nombre" class="col-md-3 col-form-label text-md-right">Nombre:</label>

                                            <div class="col-md-9">
                                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus>                                            
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="correo" class="col-md-3 col-form-label text-md-right">Correo:</label>

                                            <div class="col-md-9">
                                                <input id="correo" type="email" class="form-control" name="email" value="{{ old('correo') }}" autocomplete="correo">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="clave" class="col-md-3 col-form-label text-md-right">Clave:</label>

                                            <div class="col-md-9">
                                                <input id="clave" type="password" class="form-control" name="clave" autocomplete="clave">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="clave-confirm" class="col-md-3 col-form-label text-md-right">Confirma:</label>

                                            <div class="col-md-9">
                                                <input id="clave-confirm" type="password" class="form-control" name="clave_confirmation" autocomplete="clave">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-sm-12">
                                                <button id="btnRegistrar" type="button" class="btn btn-warning btn-block">
                                                    Registrarme
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>¿No tienes cuenta? 
                                 <a href="javascript: showRegisterForm();">¡Registrate!</a>
                            </span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>¿Ya tienes cuenta?</span>
                             <a href="javascript: showLoginForm();">Inicia sesión</a>
                        </div>
                    </div>        
              </div>
          </div>
    </div>
    {{-- login modal --}}