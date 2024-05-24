@extends('store.partials.principal')
@section('title',"Historial de compras")
@section('activeUser',"active")
@section('content')
<!-- contenido -->
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-10 ">
            <div class="card text-center">
                <div class="card-header bg-warning text-white">
                    <h4>Historial de pedidos</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">                            
                        </div>
                        <div class="col-12">
                            <div class="tab-content" id="nav-tabContent">
                                <!-- nav 1 (carrito) -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-carrito">
                                @if (count($productos) < 1 )
                                    <div class="row my-5 justify-content-center"> 
                                        <h3>¡Aún no tienes compras!</h3>
                                        <div class="col-12">
                                            <a href="{{ route('products.index') }}">Ver productos</a>
                                        </div>
                                    </div>   
                                @endif                                
                                @for ($i = 0; $i < count($productos) ; $i++)
                                <div class="row justify-content-start">
                                    <div class="col-md-3">
                                        <label class="h5">Orden: {{ $productos[$i]->id }}</label>
                                        <form action="{{ route('cart.pdf') }}" method="post">
                                            @csrf 
                                            <input type="hidden" name="id" value="{{ $productos[$i]->id}}">                                           
                                            <button class="btn btn-outline-warning btn-sm">Exportar detalle <i class="fas fa-file-pdf fa-2x"></i></button>
                                        </form>
                                    </div>
                                 </div>
                                   @foreach ($productos[$i]->products as $prod)
                                        <div class="row my-3">                          
                                            <div class="col-5">
                                            @isset ($prod->images)
                                                @foreach ($prod->images as $imge)
                                                    <img src="{{ asset('img/productos/' . $imge->img) }}" class="img-fluid card-img-top" style="width: 220px; height: 200px">
                                                @break                                        
                                                @endforeach                                                
                                            @endisset
                                            </div>
                                        <div class="col-7 text-left">
                                            <div class="form-group">
                                                <label class="h3">{{ $prod->productName }}</label>                                              
                                            </div>
                                            <div class="form-group">                                                   
                                                <label class="h5">precio: ${{ $prod->salePrice }}</label>
                                                <input class="precio" type="hidden" value="{{ $prod->salePrice }}">
                                            </div>
                                            <div class="form-group">
                                                 <label class="h5">Cantidad: {{ $prod->pivot->quantity }}</label>                                                
                                            </div>
                                             <div class="form-group">
                                                <label class="h5 subTotal">Sub total: ${{ $prod->pivot->subTotal }}</label>                                                
                                            </div>
                                        </div>  
                                        </div>
                                        <hr class="bg-warning">                                                           
                                    @endforeach
                                    <div class="row justify-content-end">
                                        <div class="col-md-6">
                                            <label class="h5">Total: ${{ $productos[$i]->total }}</label>
                                        </div>
                                     </div>

                                    <hr class="bg-dark"> 
                                @endfor                                  
                                </div><!-- nav 1 (carrito) -->                                             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted bg-warning d-flex justify-content-center">
                    <!-- text -->
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
</div> <!-- contenido -->
@endsection
@section('scriptsFooter')

<script>   
   
    $(function(){
            
    })
   
</script>
@endsection