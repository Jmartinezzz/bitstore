@extends('store.partials.principal')
@section('title',"Inicio")
@section('activeInicio',"active")
@section('content')
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
            <div class="input-group">
                <div class="custom-file">
                    <input type="search" class="form-control" placeholder="Ingresa el nombre del articulo que deseas">
                </div>
                <div class="input-group-append">
                    <button class="btn btn-warning" type="button" id="inputGroupFileAddon04">Buscar</button>
                </div>
            </div>
        </div>
    </div><!-- buscador -->
    <!-- promociones semanales -->
    <div class="jumbotron mt-4">
        <h1 class="display-4 text-center mb-4">Promociones semanales</h1>
        <div class="row">
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
            <img src="https://w.wallhaven.cc/full/13/wallhaven-13mk9v.jpg" height="440" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://w.wallhaven.cc/full/xl/wallhaven-xlekzz.jpg" height="440" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://w.wallhaven.cc/full/76/wallhaven-76rg6o.png" height="440" class="d-block w-100" alt="...">
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

<div class="container mt-3 shadow">
    <!-- productos mas vendidos -->
    <div class="jumbotron mt-4">
        <h1 class="display-4 text-center mb-4">Productos más vendidos</h1>
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png" class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <button class="btn btn-sm btn-outline-success float-right">button</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png" class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <button class="btn btn-sm btn-outline-success float-right">button</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="img/ard.png" class="card-img-top" width="100">
                    <div class="card-body">
                        <h5 class="card-title">Titulo del producto</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <button class="btn btn-sm btn-outline-success float-right">button</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- productos mas vendidos -->
</div>

@endsection
@section('scriptsFooter')
<script>
    $('#indicadores').carousel({
        interval: 3000
    });
    $(function() {
    });
</script>
@endsection