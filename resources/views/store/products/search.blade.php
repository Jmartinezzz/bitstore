@extends('store.partials.principal')
@section('title',"Resultados de búsqueda")
@section('activeProducts',"active")
@section('content')
<div class="container mt-4 shadow">       
    <!-- resultados de busqueda -->
    <div class="jumbotron">
        <h1 class="rounded display-4 text-center text-white mb-5 p-2 bg-gradient-warning">Resultados de búsqueda</h1>
        <div class="row">
            @forelse ($products as $prod)
            <div class="col-md-4 col-sm-6 mb-2">
                <div class="card">
                    @foreach ($prod->images as $imge)
                        <a href="{{ route('product.detail', $prod) }}">
                            <img src="{{ asset('img/productos/' . $imge->img) }}" class="img-fluid card-img-top" style="width: 100%; height: 300px">
                        </a>
                        
                    @break
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $prod->productName }}</h5>                   
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
                                <form method="post" action="{{ route('buy', $prod->id) }}" class="d-inline">
                                    @csrf
                                    <button type="button" data-toggle="tooltip" data-placement="bottom" title="Comprar" class="btnComprar btn btn-sm btn-outline-warning"><i class="fas fa-credit-card fa-2x "></i></button>  
                                </form>
                            </div>
                            @endguest
                            
                        </div>
                    </div>
                </div>
            </div> 
            @empty
                <div class="col-12 text-dark">
                    <p class="text-center">No se encontraron resultados en la búsqueda</p>
                </div>  
            @endforelse
        </div>        
    </div><!-- resultados de busqueda -->    
    <!-- que buscas -->
        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <h1 class="display-4">¿Aún no lo encuentras?</h1>
            </div>
            <div class="w-100"></div>
            <div class="col-6">
                <p>Encuentra lo que buscas en nuestro buscador</p>
            </div>
        </div><!-- que buscas -->
        <!-- buscador -->
        <div class="row justify-content-center mb-5">
            <div class="col-10 mb-5">
                <form id="formBuscar" action="{{ route('products.search') }}" method="post">
                    @csrf                
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="search" class="form-control" placeholder="Ingresa el nombre del articulo que deseas" name="buscar" value="{{ old('buscar') }}">
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

</div>        
@endsection
@section('scriptsFooter')
<script>   
    $(function() {

        $('[data-toggle="tooltip"]').tooltip();     

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

    });
</script>
@endsection
