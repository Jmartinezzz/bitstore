 <!-- Footer -->
<footer class="page-footer font-small black darken-3">
    <div class="container pt-3">
        {{-- newsletter --}}
        <div class="row text-center ">
            <div class="col-12">
                <p class="display-4">¿Quieres estar al tanto de nuestas promociones?</p>
            </div>
            <div class="col-12">
                <p class="h5 lead text-center">pues dejanos tu correo, es completamente gratis</p>
            </div>
        </div>
          <!-- input -->
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form id="formSubscription">
                    @csrf                    
                    <div class="input-group">
                        <div class="custom-file">
                            <input id="correoe" type="email" class="form-control" placeholder="Comparte tu e-mail" name="email" style="color:white;">
                        </div>
                        <div class="input-group-append">
                            <button id="btnSuscripcion" class="btn btn-warning" type="button">Suscribirme</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- input -->

        {{-- newsletter --}}
        <div class="row">
            <div class="col-md-12 pt-5">                    	
                <div class="mb-5 flex-center">
                    <!-- Facebook -->
                    <a class="fb-ic" target="_blank" href="https://www.facebook.com/Bitstoresv/">
                        <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!-- Twitter -->
                    <a class="tw-ic">
                        <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>                                                    
                    <!--Instagram-->
                    <a class="ins-ic">
                        <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>                                             
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright -->
    <hr class="bg-white">
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/"> Bitstore.com</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
</main>
    <script src="{{ asset('store/js/plantilla.js') }}"></script>
    <script>
        var data; 
        var token;
        var route;        

        $("body").niceScroll({
            cursorcolor:"orange",
            cursorwidth:"9px",
            cursorborder:'none',
        });

        $('.btnComprar').on('click', function(){                    
            token = $('input[name=_token]').val();
            route = $(this).parents('form:first').attr('action'); 

            $.ajax({
                url: route,
                headers:{'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType:"json",
                success:function(data){     
                    if (data.mensaje == 'existe') {
                        $(location).attr('href',"{{ route('cart') }}");                       
                        alertify.warning('Producto Existente en el carrito');
                        
                    }else if (data.mensaje == 'agregado') {
                        $(location).attr('href',"{{ route('cart') }}");
                        alertify.warning('Producto Agregado al carrito');                        
                    }
                
                },
                error:function(data){
                    console.log(data);
                    alertify.error('Se produjo un error');                                                                    
                }
            })              
        });

        $('#btnSuscripcion').on('click', function(){
            token = $('input[name=_token]').val();            
            datos = $('#formSubscription').serialize();            

            $.ajax({
                url: '{{ route('store.subscribe') }}',
                headers:{'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType:"json",
                data:datos,
                success:function(data){     
                    if (data.mensaje == 'guardado') {               
                        alertify.warning('Gracias por tu registro');
                        $("#correoe").val("");                        
                    }                
                },
                error:function(data){
                    console.log(data);
                    var errores = "¡Atención! <br>"
                    if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function(i, valor){
                            errores += valor;
                        });                        
                    }else{
                        errores += "se produjo un error";
                    }
                    alertify.success(errores);          
                }
            })              
        });

        if (window.matchMedia("(max-width: 440px)").matches) {            
            $('.carru').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,           
                autoplay: true,     
                lazyLoad: 'ondemand'
            });
        }else if (window.matchMedia("(max-width: 991px)").matches) {
            $('.carru').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 1,           
                autoplay: true,     
                lazyLoad: 'ondemand'
            });
        }else{
            $('.carru').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,           
                autoplay: true,     
                lazyLoad: 'ondemand'
            });            
        }
        
    </script>
    @guest()
        <script>
            var data = $('#formLogin').serialize();             
            var token = $('input[name=_token]').val();
            var route = $(this).parents('form:first').attr('action'); 

            $('#btnLogin').on('click',function(){              
                data = $('#formLogin').serialize();             
                token = $('input[name=_token]').val();
                route = $(this).parents('form:first').attr('action');               

                $.ajax({
                    url: route,
                    headers:{'X-CSRF-TOKEN':token},
                    type: 'POST',
                    dataType:"json",
                    data:data,
                    beforeSend: function( xhr ) { 
                        $('#btnLogin').text('Verificando ');                      
                        $('#btnLogin').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                        
                        $('#btnLogin').attr('disabled', 'disabled');
                    },
                    success:function(data){     
                        if (data.mensaje = "existe") {
                            alertify.warning('Acceso correcto...');
                            window.location.reload();
                        }
                    },
                    error:function(data){
                        var errores = "¡Atención!";                        
                        if (data.responseJSON.errors) {
                            $.each(data.responseJSON.errors, function(i, valor){
                                errores += valor;
                            });                       
                            alertify.success(errores);
                            $('#btnLogin').removeAttr('disabled');
                            $('#btnLogin').text('Acceder');
                        }                                                                    
                    }
                })
            });

            $('#btnRegistrar').on('click',function(){              
                data = $('#formRegistrar').serialize();             
                token = $('input[name=_token]').val();
                route = $(this).parents('form:first').attr('action');               

                $.ajax({
                    url: route,
                    headers:{'X-CSRF-TOKEN':token},
                    type: 'POST',
                    dataType:"json",
                    data:data,
                    beforeSend: function( xhr ) { 
                        $('#btnRegistrar').text('Verificando ');                      
                        $('#btnRegistrar').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                        
                        $('#btnRegistrar').attr('disabled', 'disabled');
                    },
                    success:function(data){     
                        if (data.mensaje = "creado") {
                            alertify.warning('Cuenta creada con Éxito');
                            window.location.reload();
                        }
                    },
                    error:function(data){
                        var errores = "¡Atención!";                        
                        if (data.responseJSON.errors) {
                            $.each(data.responseJSON.errors, function(i, valor){
                                errores += "<li>" +valor + "</li>";
                            });                       
                            alertify.success(errores);
                            $('#btnRegistrar').removeAttr('disabled');
                            $('#btnRegistrar').text('Registrarme');
                        }                                                                    
                    }
                })
            });


        </script>
    @endguest
    @yield('scriptsFooter')    
</body>

</html>