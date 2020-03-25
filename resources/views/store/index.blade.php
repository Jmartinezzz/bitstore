@extends('store.partials.principal')
@section('title',"Inicio")
@section('activeInicio',"active")
@section('content')
<!-- banner inicio -->
<div>
    <img class="img-fluid" src="{{ asset('img/locales/banner.jpg') }}">     
</div><!-- banner inicio -->

<div class="container mt-4 shadow">
    <!-- que buscas -->
    <div class="row justify-content-center text-center">
        <div class="col-6">
            <h1 class="display-4">¿Qué buscas?</h1>
        </div>
        <div class="w-100"></div>
        <div class="col-6">
            <p>Encuentra lo que buscas en nuestro buscador</p>
        </div>
    </div><!-- que buscas -->
    <!-- buscador -->
    <div class="row justify-content-center">
        <div class="col-10">
            <form id="formBuscar" action="{{ route('products.search') }}" method="post">
                @csrf                
                <div class="input-group">
                    <div class="custom-file">
                        <input type="search" class="form-control" placeholder="Ingresa el nombre del articulo que deseas" name="buscar">
                        <select class="form-control w-50" name="categoria" id="">
                            <option value="0">Todas las categorias</option>
                            <option value="1">Placas</option>
                            <option value="2">Sensores</option>
                            <option value="3">Componentes</option>
                        </select>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-warning" type="submit" id="btnBuscar">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- buscador -->
    <!-- promociones semanales -->
    <div class="jumbotron mt-4">
        <h1 class="rounded display-4 text-center text-white mb-5 p-2 bg-gradient-warning">Promociones semanales</h1>
        <div class="row carru">
            @foreach ($products as $prod)
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="card">
                    @foreach ($prod->images as $imge)
                    <a href="{{ route('product.detail', $prod) }}">
                       <img src="{{ asset('img/productos/' . $imge->img) }}" class="card-img-top img-fluid" style="width: 100%; height: 300px"> 
                    </a>                        
                    @break
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $prod->productName . " $" . $prod->salePrice }}</h5>                        
                        <div class="row justify-content-center">
                            @guest()
                            <div class="col-3">                               
                                <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></a>  
                            </div>
                            <div class="col-3">
                                <a href="{{ route('product.detail', $prod) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div>
                            <div class="col-3">
                                <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x"></i></a>
                            </div>
                            @else                          
                            <div class="col-3">
                               <form class="formAddCarrito" method="post" action="{{ route('addCart', $prod->id) }}">
                                    @csrf
                                    <button type="button" class="btnAddCarrito btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></button>  
                               </form>                      
                            </div>
                            <div class="col-3">
                                <a href="{{ route('product.detail', $prod) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div> 
                            <div class="col-3">
                                <form method="post" action="{{ route('buy', $prod) }}" class="d-inline">
                                    @csrf
                                    <button type="button" class="btnComprar btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x "></i></button>  
                                </form>
                            </div>
                            @endguest
                            
                        </div>
                    </div>
                </div>
            </div>   
            @endforeach             
        </div>
    </div><!-- promociones semanales -->
</div>
<!-- slideshow -->
<div id="indicadores" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#indicadores" data-slide-to="0" class="active"></li>
        <li data-target="#indicadores" data-slide-to="1"></li>
        <li data-target="#indicadores" data-slide-to="2"></li>     
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('img/locales/bts3.jpg') }}" class="img-fluid d-block w-100 " style="min-height: 150px;max-height: 420px">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/locales/logo1.jpg') }}" class="d-block w-100 img-fluid" style="min-height: 150px;max-height: 420px">
        </div>
        <div class="carousel-item ">
            <img src="{{ asset('img/locales/ard2.jpg') }}" class="d-block w-100 img-fluid" style="min-height: 150px;max-height: 420px">
        </div>               
    </div>
    <a class="carousel-control-prev" href="#indicadores" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#indicadores" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- slideshow -->

<div class="container shadow my-4">
    <!-- mas vendidos -->
    <div class="jumbotron">
            <h1 class="rounded display-4 text-center text-white mb-5 p-2 bg-gradient-warning">Los más vendidos</h1>
            <div class="row carru">
                @foreach ($products as $prod)
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="card">
                        @foreach ($prod->images as $imge)
                        <a href="{{ route('product.detail', $prod) }}">
                            <img src="{{ asset('img/productos/' . $imge->img) }}" class="card-img-top img-fluid" style="width: 450px; height: 300px">
                        </a>                            
                        @break
                        @endforeach
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $prod->productName . " $" . $prod->salePrice }}</h5>                        
                            <div class="row justify-content-center">
                                @guest()
                                <div class="col-3">                               
                                    <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></a>  
                                </div>
                                <div class="col-3">
                                    <a href="{{ route('product.detail', $prod) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                                </div>
                                <div class="col-3">
                                    <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x"></i></a>
                                </div>
                                @else                          
                                <div class="col-3">
                                   <form class="formAddCarrito" method="post" action="{{ route('addCart', $prod->id) }}">
                                        @csrf
                                        <button type="button" class="btnAddCarrito btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></button>  
                                   </form>                      
                                </div>
                                <div class="col-3">
                                    <a href="{{ route('product.detail', $prod) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                                </div> 
                                <div class="col-3">
                                    <form method="post" action="{{ route('buy', $prod) }}" class="d-inline">
                                    @csrf
                                    <button type="button" class="btnComprar btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x "></i></button>  
                                </form>
                                </div>
                                @endguest
                                
                            </div>
                        </div>
                    </div>
                </div>   
                @endforeach             
            </div>
    </div><!-- mas vendidos -->
</div>



@endsection
@section('scriptsFooter')
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $('#indicadores').carousel({
        interval: 3000
    });
    

    $('.btnAddCarrito').on('click', function(){                            
            var token = $('input[name=_token]').val();
            var route = $(this).parents('form:first').attr('action');               

            $.ajax({
                url: route,
                headers:{'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType:"json",
                success:function(data){     
                    if (data.mensaje == 'existe') {
                        alertify.warning('Producto Existente en el carrito');
                    }else if (data.mensaje == 'agregado') {
                        alertify.warning('Producto Agregado al carrito');
                    }
                
                },
                error:function(data){
                    console.log(data);
                    alertify.error('Se produjo un error');                                                                    
                }
            })
    });   

</script>
@endsection