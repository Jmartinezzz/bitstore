@extends('store.partials.principal')
@section('title', $product->productName)
@section('activeProducts',"active")
@section('content')
 <div class="container mt-4 shadow">
            <div class="row mt-5">
                <div class="col-md-6 ">
                    <div class="col-10 ">
                        <div class="slider-for">
                            <div class="item">
                                <img class="img-fluid" src="img/ard.png" alt="image" width="450" />
                            </div>
                            <div class="item">
                                <img class="img-fluid" src="img/ard2.jpg" alt="image"  width="450"/>
                            </div>
                            <div class="item">
                                <img class="img-fluid" src="img/ard3.png" alt="image" width="450" />
                            </div>                            
                        </div>

                        <div class="slider-nav">
                             <div class="item">
                                <img class="img-fluid" src="img/ard.png" alt="image"  />
                            </div>
                            <div class="item">
                                <img class="img-fluid" src="img/ard2.jpg" alt="image" />
                            </div>
                            <div class="item">
                                <img class="img-fluid" src="img/ard3.png" alt="image" />
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1>{{ $product->productName }}</h1>
                    <p class="lead text-justify mb-5">{{ $product->description }}</p>
                     <a href="product.html" class="btn btn-outline-warning"><i class="fas fa-shopping-cart  fa-2x"></i> Agregar</a>
                     <a href="cart.html" class="btn btn-outline-warning ml-2"><i class="fas fa-credit-card  fa-2x"></i> Comprar</a>
                </div>
            </div>        

            <!-- Recien llegados -->
            <div class="jumbotron mt-4">
                <h1 class="display-4 text-center mb-4">Articulos similares</h1>
                <div class="row carru">
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                            <img src="img/ard.png" class="card-img-top" width="30">
                            <div class="card-body">
                                <h5 class="card-titl text-center">Titulo del producto</h5>                            
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right"><i class="fas fa-shopping-cart  fa-2x"></i></a>
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right mr-3"><i class="fas fa-eye fa-2x"></i></a>
                            </div>
                        </div>
                    </div>   
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                            <img src="img/ard.png" class="card-img-top" width="30">
                            <div class="card-body">
                                <h5 class="card-titl text-center">Titulo del producto</h5>                            
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right"><i class="fas fa-shopping-cart  fa-2x"></i></a>
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right mr-3"><i class="fas fa-eye fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                            <img src="img/ard.png"  class="card-img-top" width="30">
                            <div class="card-body">
                                <h5 class="card-title text-center">Titulo del producto</h5>                            
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right"><i class="fas fa-shopping-cart  fa-2x"></i></a>
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right mr-3"><i class="fas fa-eye fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                            <img src="img/ard.png"  class="card-img-top" width="30">
                            <div class="card-body">
                                <h5 class="card-title text-center">Titulo del producto</h5>                            
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right"><i class="fas fa-shopping-cart  fa-2x"></i></a>
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right mr-3"><i class="fas fa-eye fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                            <img src="img/ard.png"  class="card-img-top" width="30">
                            <div class="card-body">
                                <h5 class="card-title text-center">Titulo del producto</h5>                            
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right"><i class="fas fa-shopping-cart  fa-2x"></i></a>
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right mr-3"><i class="fas fa-eye fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card">
                            <img src="img/ard.png"  class="card-img-top" width="30">
                            <div class="card-body">
                                <h5 class="card-title text-center">Titulo del producto</h5>                            
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right"><i class="fas fa-shopping-cart  fa-2x"></i></a>
                                <a href="product.html" class="btn btn-sm btn-outline-warning float-right mr-3"><i class="fas fa-eye fa-2x"></i></a>
                            </div>
                        </div>
                    </div>                 
                </div>
            </div><!-- Recien llegados -->
        </div>       
@endsection
@section('scriptsFooter')
<script>   
    $(function() {

        $('[data-toggle="tooltip"]').tooltip();

        $('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          centerMode: true,
          focusOnSelect: true
        });

       

        $('.btnAddCarrito').on('click', function(){               
            var data = $('#formAddCarrito').serialize();             
            var token = $('input[name=_token]').val();
            var route = $(this).parents('form:first').attr('action');               

            $.ajax({
                url: route,
                headers:{'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType:"json",
                data:data,
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
