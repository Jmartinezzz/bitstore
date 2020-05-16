<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/logos/ico2.png') }}" />
    <title>Bitstore</title>        
   <link rel="stylesheet" href="{{ asset('store/css/plantilla.css') }}">  
</head>
<body style="background-color: #030303">
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
                    <a class="nav-link" href="{{ route('products.index') }}">Ir a la tienda</a>
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
                         <a class="dropdown-item" href="{{ route('history') }}">
                            Historial
                        </a>
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
                  <h4 class="modal-title text-white">Registrate...</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                        
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">                              
                                <div class="form loginBox" style="display:none;">
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
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 ">
                                                <button id="btnLogin" type="button" class="btn btn-warning btn-block">
                                                    {{ __('Login') }}
                                                </button>                                               
                                            </div>
                                        </div>
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" >
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
                        <div class="forgot login-footer" style="display:none">
                            <span>¿No tienes cuenta? 
                                 <a href="javascript: showRegisterForm();">¡Registrate!</a>
                            </span>
                        </div>
                        <div class="forgot register-footer" >
                             <span>¿Ya tienes cuenta?</span>
                             <a href="javascript: showLoginForm();">Inicia sesión</a>
                        </div>
                    </div>        
              </div>
          </div>
    </div>
    {{-- login modal --}}

    {{-- imagenes --}}
  
    <div id="landinf3" class="carousel slide " data-ride="carousel">
	    <div class="parallax-window img-fluid" data-parallax="scroll" data-image-src="{{ asset('img/landing/l2.jpg') }}" style="height: 600px">
	      <div class="carousel-caption d-block" style="top: 40%">
	        <h5 class="display-4 display-md-1 text-break" style="background-color: rgba(0,0,0,0.8);border-radius: 4px">SOMOS BITSTORE</h5>
	        <p class="h3" style="background-color: rgba(0,0,0,0.8);border-radius: 4px; padding: 10px">La tienda de placas arduino y sensores que estabas esperando para poder llevar a cabo tus proyectos de electrónica y robótica.</p>
	        
	      </div>
	    </div>
	</div>

    <div id="landinf2" class="carousel slide " data-ride="carousel">
	    <div id="imgcenter" class="parallax-window img-fluid" data-parallax="scroll" data-image-src="{{ asset('img/landing/l1.jpg') }}" style="height: 470px">
	      <div id="buttonTop" class="carousel-caption d-block" style="top: 40%">
	      	<a href="{{ route('products.index') }}" class="btn btn-lg btn-warning mb-3 mb-md-0">¡Quiero ver los productos!</a>	        
	        <button data-toggle="modal" data-target="#loginModal" class="btn btn-lg btn-warning">¡Me quiero registrar!</button>
	      </div>
	    </div>
	</div>

    <div id="landinf1" class="carousel slide " data-ride="carousel">
	    <div class="parallax-window img-fluid" data-parallax="scroll" data-image-src="{{ asset('img/landing/l3.jpg') }}" style="height: 680px">
	      <div class="carousel-caption d-inline d-md-block">
	      	<h2 style="background-color: rgba(0,0,0,0.7);border-radius: 3px;padding: 8px">Crea tus propios proyectos con nuestros productos.</h2>
	        <div class="row">
	        	<div class="col-md-4">
	        		<div class="card border-warning text-dark mb-3">
					  <img src="{{ asset('img/locales/p1.jpg') }}" class="card-img-top img-fluid" style="height: 180px">
					  <div class="card-body">
					    <h5 class="card-title">Carrito con sensor de ultrasonido</h5>
					    <p class="card-text">carrito que sabe donde hay una pared gracias a un sensor de ultrasonido.</p>					    
					  </div>
					</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div class="card border-warning text-dark mb-3">
					  <img src="{{ asset('img/locales/p2.jpg') }}" class="card-img-top img-fluid" style="height: 180px">
					  <div class="card-body">
					    <h5 class="card-title">Arduino y servos</h5>
					    <p class="card-text">potenciometro que controla el movimiento de un servomotor.</p>
					  </div>
					</div>
	        	</div>
	        	<div class="col-md-4">
	        		<div class="card border-warning text-dark">
					  <img src="{{ asset('img/locales/p3.jpg') }}" class="card-img-top img-fluid" style="height: 180px">
					  <div class="card-body">
					    <h5 class="card-title">Arduino 1 y pantalla led</h5>
					    <p class="card-text">captura de datos con un sensor y mostrada en una pantalla led 16x16.</p>
					  </div>
					</div>
	        	</div>
	        </div>
	      </div>
	    </div>
	</div>
    {{-- landign juego --}}
    <div  class="container mb-5 pb-5 mt-4">
        <div class="row justify-content-center pt-5 mb-3">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('img/logos/logo4.png') }}" alt="">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9 text-center">
                <p class="h1 font-weight-normal text-white text-break">Participa en el reto que tenemos para tí</p>
                <p class="text-white">Completa el reto 2048, comparte una captura con el reto completado en nuestra fanpage y podras obtener un descuento incríble en tu primera compra.</p>
                <a href="{{ route('juego') }}" target="_blank" class="btn btn-lg btn-warning mt-4">¡Jugar ahora!</a>
                <div class="w-100"></div>
                <img class="mt-3 img-fluid" src="{{ asset('img/locales/m2.svg') }}" style="height: 150px" >
            </div>
        </div>         
        <hr class="mt-5 bg-white">        
    </div>
  
  
    {{-- imagenes --}}
@include('store.partials.footer')