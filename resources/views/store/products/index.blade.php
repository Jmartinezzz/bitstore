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
            <div class="col-3 col-sm-6 mb-2">
                <div class="card">
                    @foreach ($placa->images as $imge)
                        <img src="{{ asset('img/productos/' . $imge->img) }}" class="card-img-top" style="width: 300px; height: 300px">
                    @break
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $placa->productName }}</h5>                   
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <a href="product.html" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></a>                        
                            </div>
                            <div class="col-3">
                                <a href="product.html" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div>
                            <div class="col-3">
                                <a href="product.html" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            @endforeach                        
        </div>
    </div><!-- placas -->

    <!-- sensores -->
    {{-- <div class="jumbotron mt-4">
        <h1 class="display-4 text-center mb-4">Recien llegados</h1>
        <div class="row carru">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png" class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="product.html" class="btn btn-sm btn-outline-success float-right">button</a>
                    </div>
                </div>
            </div>   
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png" class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="product.html" class="btn btn-sm btn-outline-success float-right">button</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png"  class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="product.html" class="btn btn-sm btn-outline-success float-right">button</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png"  class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="product.html" class="btn btn-sm btn-outline-success float-right">button</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png"  class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="product.html" class="btn btn-sm btn-outline-success float-right">button</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png"  class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="product.html" class="btn btn-sm btn-outline-success float-right">button</a>
                    </div>
                </div>
            </div>                 
        </div>
    </div> --}}<!-- sensores -->

    <!-- componentes -->
    <div class="jumbotron mt-4">
        <h1 class="display-4 text-center mb-4">Componentes</h1>
        <div class="row carru">
            @foreach ($componentes as $compo)
            <div class="col-3 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png" class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $compo->productName }}</h5>                        
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <a href="product.html" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></a>                        
                            </div>
                            <div class="col-3">
                                <a href="product.html" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div>
                            <div class="col-3">
                                <a href="product.html" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x"></i></a>
                            </div>
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

        $('.carru').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,           
            autoplay: true,     
            lazyLoad: 'ondemand'
        });

    });
</script>
@endsection
