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
                <div class="input-group">
                    <div class="custom-file">
                        <input type="mail" class="form-control" placeholder="Comparte tu e-mail" style="color:white;">
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-warning" type="button">Suscribirme</button>
                    </div>
                </div>
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
        $("body").niceScroll({
            cursorcolor:"orange",
            cursorwidth:"9px",
            cursorborder:'none',
        });
        
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