@extends('store.partials.principal')
@section('title', 'Contactanos')
@section('activeContact',"active")
@section('content')
	<div class="container">
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Contáctanos        
      </h1>     
      <!-- Content Row -->
      <div class="row">
        <!-- Map Column -->
        <div class="col-6 col-lg-8 mb-4">
          <!-- Embedded Google Map -->
          <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15505.867639643608!2d-89.25171477983555!3d13.690147596196601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f633028df64891b%3A0xab4bfef18ab598e5!2sSan+Benito%2C+San+Salvador!5e0!3m2!1ses!2ssv!4v1542377430753" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
          <h3>Detalles de contacto</h3>
          <p>
            1502 Col. San Benito.
            <br>San salvador, ESA 90210
            <br>
          </p>
          <p>
            <abbr title="Telefono">T</abbr>: (503) 7437-7411
          </p>
          <p>
            <abbr title="Correo Electronico">E</abbr>:
            <a>contacto@bitstoresv.com
            </a>
          </p>
          <p>
            <abbr title="Horas">H</abbr>: Lunes - Viernes: 9:00 AM - 5:00 PM
          </p>
        </div>
      </div>
      <!-- /.row -->

      <!-- Contact Form -->
      <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
      <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Envianos un mensaje</h3>
          <form id="contactForm" >
            @csrf            
            <div class="control-group form-group">
              <div class="controls">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" required name="name">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label for="phone">Telefono:</label>
                <input type="text" class="form-control" id="phone" name="phone">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label for="email">*Correo:</label>
                <input type="email" class="form-control" name="email" >
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label for="mensaje">*Mensaje:</label>
                <textarea rows="3" cols="100" class="form-control" id="mensaje"  maxlength="299" style="resize:none" name="mensaje"></textarea>
              </div>
            </div>
            <!-- For success/fail messages -->
            <button type="button" id="btnContactUs" class="btn btn-block btn-lg btn-warning">Enviar</button>
          </form>
        </div>

      </div>
      <!-- /.row -->
    </div>
@endsection
@section('scriptsFooter')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
  <script>
    if (window.matchMedia("(max-width: 440px)").matches) {            
            $('#mapa').width('380px');
    }

    $(function(){
      $('#phone').mask('0000-0000');
    });

    
    $('#btnContactUs').on('click', function(){
      var datos = $('#contactForm').serialize();
      var token = $('input[name=_token]').val();                  

      $.ajax({
          url: '{{ route('contactus') }}',
          headers:{'X-CSRF-TOKEN':token},
          type: 'POST',
          dataType:"json",
          data:datos,
          beforeSend: function( xhr ) { 
              $('#btnContactUs').text('Enviando... ');                      
              $('#btnContactUs').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
              
              $('#btnContactUs').attr('disabled', 'disabled');
          },
          success:function(data){     
              if (data.mensaje = "creado") {
                  alertify.warning('Gracias por tu mensaje');
                  $('#btnContactUs').removeAttr('disabled');
                  $('#btnContactUs').text('Registrarme');
                  $('#contactForm')[0].reset();
              }
          },
          error:function(data){
              var errores = "¡Atención!";                        
              if (data.responseJSON.errors) {
                  $.each(data.responseJSON.errors, function(i, valor){
                      errores += "<li>" +valor + "</li>";
                  });                       
                  alertify.success(errores);
                  $('#btnContactUs').removeAttr('disabled');
                  $('#btnContactUs').text('Enviar');
              }                                                                    
          }
      })
    });
    
  </script>
@endsection