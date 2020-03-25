@extends('store.partials.principal')
@section('title', $product->productName)
@section('activeProducts',"active")
@section('content')
<div class="container mt-4 shadow">
    <div class="row mt-5 mb-3">
        <div class="col-md-6 ">
            <div class="col-10 ">
                <div class="slider-for">
                    @foreach ($product->images as $img)
                        <div class="item">
                        <img class="img-fluid" src="{{ asset('img/productos/' . $img->img) }}" style="width: 90%; height: 100%;" />
                    </div>
                    @endforeach
                </div>

                <div class="slider-nav">
                    @foreach ($product->images as $img)
                    <div class="item">
                        <img class="img-fluid" src="{{ asset('img/productos/' . $img->img) }}"/>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h1>{{ $product->productName }} <p class="d-inline ml-4 ">${{ $product->salePrice }}</p></h1>            
            <p class="lead text-justify mb-5">{{ $product->description }}</p>
            @guest()
            <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-outline-warning"><i class="fas fa-shopping-cart  fa-2x"></i> Agregar</a>
             <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-outline-warning ml-2"><i class="fas fa-credit-card  fa-2x"></i> Comprar</a>
            @else                     
            <form method="post" action="{{ route('addCart', $product->id) }}" class="d-inline">
                @csrf
                <button type="button" class="btnAddCarrito btn btn-outline-warning "><i class="fas fa-shopping-cart fa-2x "></i>Agregar</button>  
            </form>             
            <form method="post" action="{{ route('buy', $product->id) }}" class="d-inline">
                @csrf
                <button type="button" class="btnComprar btn btn-outline-warning ml-2"><i class="fas fa-credit-card fa-2x "></i> Comprar</button>  
            </form>   
            @endguest
        </div>
    </div>
    {{-- foro para la comunidad --}}
    <div class="row border" style="height:500px">
        <div id="disqus_thread"></div>
        <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        
        var disqus_config = function () {
        this.page.url = 'bitstoresv.com';  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = {{ $product->id }}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://bitstore-1.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div>
    {{-- foro para la comunidad --}}

    <!-- Articulos similaress -->
    <div class="jumbotron mt-5">
        <h1 class="display-4 text-center mb-4">Articulos similares</h1>
        <div class="row carru">
            @foreach ($similares as $similar)
            <div class="col-3 col-sm-6 mb-4">
                <div class="card">
                     @foreach ($similar->images as $imge)
                        <img src="{{ asset('img/productos/' . $imge->img) }}" class="img-fluid card-img-top" style="width: 100%; height: 300px">
                    @break
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $similar->productName }}</h5>
                        <h5 class="text-center">{{ " $" . $similar->salePrice }}</h5>                        
                        <div class="row justify-content-center">
                        @guest()
                            <div class="col-3">                               
                                <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></a>  
                            </div>
                        @else                          
                            <div class="col-3">
                               <form class="formAddCarrito" method="post" action="{{ route('addCart', $similar->id) }}">
                                    @csrf
                                    <button type="button" class="btnAddCarrito btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Agregar al carrito"><i class="fas fa-shopping-cart fa-2x "></i></button>  
                               </form>                      
                            </div>
                        @endguest
                            <div class="col-3">
                                <a href="{{ route('product.detail', $similar) }}" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Ver"><i class="fas fa-eye fa-2x"></i></a>                       
                            </div>
                        @guest()
                            <div class="col-3">
                                <a href="" data-toggle="modal" data-target="#loginModal" class="btn btn-sm btn-outline-warning " data-toggle="tooltip" data-placement="bottom" title="Comprar"><i class="fas fa-credit-card fa-2x"></i></a>
                            </div>
                        @else
                            <div class="col-3">                                
                                <form method="post" action="{{ route('buy', $similar->id) }}" class="d-inline">
                                    @csrf
                                    <button type="button" class="btnComprar btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="bottom" title="Comprar" ><i class="fas fa-credit-card fa-2x "></i></button>  
                                </form>
                            </div>
                        @endguest
                        </div>
                    </div>
                </div>
            </div>   
            @endforeach                        
        </div>
    </div><!-- Articulos similaress -->
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

        // $('.btnComprar').on('click', function(){               
        //     var data = $('#formComprar').serialize();             
        //     var token = $('input[name=_token]').val();
        //     var route = $(this).parents('form:first').attr('action');               

        //     $.ajax({
        //         url: route,
        //         headers:{'X-CSRF-TOKEN':token},
        //         type: 'POST',
        //         dataType:"json",
        //         data:data,
        //         success:function(data){     
        //             if (data.mensaje == 'existe') {
        //                 alertify.warning('Producto Existente en el carrito');                        
        //             }else if (data.mensaje == 'agregado') {
        //                 alertify.warning('Producto Agregado al carrito');
        //             }
                
        //         },
        //         error:function(data){
        //             console.log(data);
        //             alertify.error('Se produjo un error');                                                                    
        //         }
        //     })
        // });

    });
</script>
@endsection
