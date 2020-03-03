@extends('store.partials.principal')
@section('title',"Productos")
@section('activeProducts',"active")
@section('content')
<div class="container mt-4 shadow">       
    <!-- placas -->
    <div class="jumbotron">
        <h1 class="rounded display-4 text-center text-white mb-5 p-2 bg-gradient-warning">Placas y sensores</h1>
        <div class="row carru">
            @foreach ($placas as $placa)
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="card">
                    @foreach ($placa->images as $imge)
                        <a href="{{ route('product.detail', $placa) }}">
                            <img src="{{ asset('img/productos/' . $imge->img) }}" class="img-fluid card-img-top" style="width: 300px; height: 300px">
                        </a>
                        
                    @break
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $placa->productName }}</h5>                   
                        <div class="row justify-content-center">
                            @guest()
                            <div class="col-3">                               
                                <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></a>  
                            </div>
                            <div class="col-3">
                                <a href="{{ route('product.detail', $placa) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div>
                            <div class="col-3">
                                <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x"></i></a>
                            </div>
                            @else                          
                            <div class="col-3">
                               <form class="formAddCarrito" method="post" action="{{ route('addCart', $placa->id) }}">
                                    @csrf
                                    <button type="button" class="btnAddCarrito btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></button>  
                               </form>                      
                            </div>
                            <div class="col-3">
                                <a href="{{ route('product.detail', $placa) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div> 
                            <div class="col-3">
                                <form method="post" action="{{ route('buy', $placa->id) }}" class="d-inline">
                                    @csrf
                                    <button type="button" class="btnComprar btn btn-sm btn-outline-warning"><i class="fas fa-credit-card fa-2x "></i></button>  
                                </form>
                            </div>
                            @endguest
                            
                        </div>
                    </div>
                </div>
            </div>   
            @endforeach                        
        </div>
    </div><!-- placas --> 

    <!-- componentes -->
    <div class="jumbotron mt-4">
        <h1 class="rounded display-4 text-center text-white mb-5 p-2 bg-gradient-warning">Componentes</h1>
        <div class="row carru">
            @foreach ($componentes as $compo)
            <div class="col-3 col-sm-6 mb-4">
                <div class="card">
                     @foreach ($compo->images as $imge)
                     <a href="{{ route('product.detail', $compo) }}">
                         <img src="{{ asset('img/productos/' . $imge->img) }}" class="img-fluid card-img-top" style="width: 300px; height: 300px">
                     </a>                        
                    @break
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $compo->productName . " $" . $compo->salePrice}}</h5>                        
                        <div class="row justify-content-center">
                        @guest()
                            <div class="col-3">                               
                                <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></a>  
                            </div>
                            <div class="col-3">
                                <a href="{{ route('product.detail', $compo) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div>
                            <div class="col-3">
                                <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x"></i></a>
                            </div>
                        @else                          
                            <div class="col-3">
                               <form class="formAddCarrito" method="post" action="{{ route('addCart', $compo->id) }}">
                                    @csrf
                                    <button type="button" class="btnAddCarrito btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></button>  
                               </form>                      
                            </div>
                            <div class="col-3">
                                <a href="{{ route('product.detail', $compo) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div>                                                                           
                            <div class="col-3">
                                <form method="post" action="{{ route('buy', $compo->id) }}" class="d-inline">
                                    @csrf
                                    <button type="button" class="btnComprar btn btn-sm btn-outline-warning"><i class="fas fa-credit-card fa-2x "></i></button>  
                                </form>
                            </div>
                        @endguest
                        </div>
                    </div>
                </div>
            </div>   
            @endforeach                        
        </div>
    </div><!-- componentes -->

</div>        
@endsection
@section('scriptsFooter')
<script>   
    $(function() {

        $('[data-toggle="tooltip"]').tooltip()      

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
