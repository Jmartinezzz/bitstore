@extends('store.partials.principal')
@section('title',"Carrito de compras")
@section('content')
<style>  
#btnSaveSign {
    color: #fff;
    background: #f99a0b;
    padding: 5px;
    border: none;
    border-radius: 5px;
    font-size: 20px;
    margin-top: 10px;
}
#signArea{
    max-width:304px;
    min-width: 100px;
    margin: 15px auto;
}
.sign-container {
    width: 90%;
    margin: auto;
}
.sign-preview {
    width: 150px;
    height: 50px;
    border: solid 1px #CFCFCF;
    margin: 10px 5px;
}
.tag-ingo {
    font-family: cursive;
    font-size: 12px;
    text-align: left;
    font-style: oblique;
}
.center-text {
    text-align: center;
}
</style>
<!-- contenido -->
<!-- Modal -->
<div class="modal fade" id="modalAbono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <img class="img-fluid h-100 w-100"  src="{{ asset('img/locales/abono.jpg') }}" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button id="btnPagarCuentaFin" type="button" class="btn btn-warning">Aceptar y continuar</button>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-10 ">
            <div class="card text-center">
                <div class="card-header bg-warning text-white">
                    <h4>Proceso de compra</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <nav>
                                <div class="nav nav-tabs " role="tablist" >
                                    <a class="nav-item nav-link active col-md-4" id="nav-carrito" data-toggle="tab" href="#nav-home" aria-controls="nav-home" aria-selected="true"><h5>Carrito</h5></a>

                                    <a class="nav-item nav-link col-md-4" id="nav-direccion" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><h5>Dirección</h5></a>

                                    <a class="nav-item nav-link col-md-4" id="nav-pago" data-toggle="tab" href="#nav-contact" role="tab"><h6>Pago</h6></a>
                                </div>
                            </nav>
                        </div>
                        <div class="col-12">
                            <div class="tab-content" id="nav-tabContent">
                                <!-- nav 1 (carrito) -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-carrito">
                                    @empty ($productos->products)
                                        <div class="row my-5 justify-content-center"> 
                                        <h3>¡Empieza a llenar tu carrito ahora!</h3>
                                        <div class="col-12">
                                            <a href="{{ route('products.index') }}">Ver productos</a>
                                        </div>
                                    </div>
                                    @else                                    
                                        @forelse ($productos->products as $prod)
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
                                                {{ Form::open(['route' => ['delCart',$prod] ,'method' => 'delete', 'class' => 'formdel d-inline']) }}
                                                <button type="button" class="eliminarDelCart float-right btn btn-link" data-toggle="tooltip" title="Eliminar del carrito">
                                                    <i class="fas fa-trash-alt text-dark  mr-2 fa-2x"></i>
                                                </button>   
                                                {{ Form::close() }}                                                             
                                            </div>
                                            <div class="form-group">                                                   
                                                <label class="h5">precio: ${{ $prod->salePrice }}</label>
                                                <input class="precio" type="hidden" value="{{ $prod->salePrice }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Cantidad:</label>
                                                <input name="cantidad[]" class="cantidad form-control" value="{{ $prod->pivot->quantity }}" type="number" min="1">                                                
                                            </div>
                                             <div class="form-group">
                                                <label class="h5 subTotal">Sub total: $</label> 
                                                <input name="subTotal[]" type="hidden" class="subTotalh">
                                            </div>
                                        </div>  
                                    </div>
                                    <hr class="bg-warning">
                                    @empty
                                    <div class="row my-5 justify-content-center"> 
                                        <h3>¡Empieza a llenar tu carrito ahora!</h3>
                                        <div class="col-12">
                                            <a href="{{ route('products.index') }}">Ver productos</a>
                                        </div>
                                    </div>                                   
                                    @endforelse
                                    @endempty
                                     
                                    <div class="row justify-content-end">
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label class="h5" id="total">Total: $</label>   
                                                <input type="hidden" name="totalh" id="totalh">
                                                <form class="d-inline">
                                                    @csrf                                               
                                                    <button type="button" id="btnGuardar" class="btn btn-sm btn-warning">Guardar y continuar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- nav 1 (carrito) -->

                                <!-- nav 2 (direccion) -->
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-direccion">
                                   <div class="row my-3">                  
                                        <div class="col-12">
                                            <form class="d-inline" id="formDireccion">
                                                @method('PATCH')
                                                @csrf 
                                                <div class="row">
                                                    <div class="col">
                                                    <input name="name" type="text" class="form-control" placeholder="Nombre" value="{{ $datosUsuario->name }}">
                                                    </div>
                                                    <div class="col">
                                                    <input name="lastName" type="text" class="form-control" placeholder="Apellido" value="{{ $datosUsuario->lastName }}">
                                                    </div>                                                        
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <textarea class="form-control" placeholder="Dirección" name="address" rows="2">{{ $datosUsuario->address }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                    <input type="text" class="form-control" placeholder="Ciudad" name="city" value="{{ $datosUsuario->city }}">
                                                    </div>
                                                    <div class="col">
                                                    <input id="phone" type="text" class="form-control" placeholder="Telefono" name="phone" value="{{ $datosUsuario->phone }}">
                                                    </div>                                                        
                                                </div>
                                        </div>        
                                    </div> 
                                    <div class="row justify-content-end">
                                        <div class="col-md-2">
                                             <div class="form-group">                        
                                                    <button type="button" id="btnGuardar2" class="btn btn-sm btn-warning">Guardar y continuarD</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>                                     
                                </div><!-- nav 2 (dirección) -->

                                <!-- nav 3 (payment) -->
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="row my-3">                                                
                                        <div class="col-12">
                                            <form id="formPago">
                                                @csrf
                                               {{--  <div class="row">
                                                    <div class="col">
                                                        <input name="ntarjeta" id="ntarjeta" type="text" class="form-control" placeholder="Número de tarjeta">
                                                    </div>
                                                    <div class="col-2">
                                                        <input name="fecha" id="fecha" type="text" class="form-control" placeholder="MM/YY">
                                                    </div>  
                                                    <div class="col-2">
                                                        <input name="cvv" id="cvv" type="text" class="form-control" placeholder="CVV">
                                                    </div>                                                       
                                                </div>                                                        
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input name="nombreTarjeta" type="text" class="form-control" placeholder="Nombre del tarjeta habiente">
                                                    </div>            
                                                </div> --}}
                                                <div class="row justify-content-center">
                                                    <div class="col-md-6 mt-2">
                                                        <div id="signArea" >
                                                            <h6 class="lead">Firme aqui por favor...</h6>
                                                            <div class="sig sigWrapper" style="height:auto;">
                                                                <div class="typed"></div>
                                                                <canvas class="sign-pad" id="sign-pad" height="100"
                                                                style="min-width: 100px"></canvas>
                                                                {{-- <button type="button" id="clearButton">limpiar</button> --}}
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="row mt-3 justify-content-end">
                                                    <div class="col-12">
                                                        <p class="h5 lead mb-4">¿Como prefieres pagar?</p>
                                                    </div>
                                                    <div class="col-md-3">                                                   
                                                        <div id="paypal-button-container"></div>                  
                                                    </div>
                                                    <div class="col-md-2">
                                                           <button id="btnPagarCuenta" data-target="#modalAbono" type="button" class="btn btn-warning btn-sm">Abono a cuenta</button>  
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="{{ route('store.index') }}" class="btn btn-outline-dark btn-sm"><i class="fas fa-cancel"></i> cancelar</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>        
                                    </div>    
                                </div><!-- nav 3 (payment) -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted bg-warning">
                    <!-- text -->
                </div>
            </div>
        </div>
    </div>
</div> <!-- contenido -->
@endsection
@section('scriptsFooter')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
{{-- firma --}}
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<link href="{{ asset('css/jquery.signaturepad.css') }}" rel="stylesheet">
<script src="{{ asset('js/numeric-1.2.6.min.js') }}"></script> 
<script src="{{ asset('js/bezier.js') }}"></script>
<script src="{{ asset('js/jquery.signaturepad.js') }}"></script> 

<script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AXRNXKcWxh4NfekDUGFVrTdifAMmVJJxSP7LX6og1j3As_Hty4UxMaaWeDVOnPknxJgck4kLM9Z1Xy6o&currency=USD"></script>
<script>   
    var cantidad;
    var precio;
    var subTotal;
    var datos;
    var total = 0;

    function calcularTotal(){
        total = 0;
        $('.subTotalh').each(function() {
            total += parseFloat($(this).val());
            $('#total').empty().append('Total :$' + total.toFixed(2))
            $('#totalh').empty().val(total.toFixed(2))
        });
    }   

    $('.cantidad').on('change', function(){
        cantidad = parseFloat($(this).val());
        precio = parseFloat($(this).parent().siblings('div').find('.precio').val());
        subTotal = cantidad * precio;
        $(this).parent().siblings('div').find('.subTotal').html('Sub total: $' + subTotal.toFixed(2));
        $(this).parent().siblings('div').find('.subTotalh').val(subTotal);
        calcularTotal();
    });

    $('.eliminarDelCart').on('click', function(){ 
        let route = $(this).parents('form').attr('action'); 
        alertify.confirm('Eliminar del carrito', '¿Estàs seguro de eliminar del carrito?', function(){ 
                      
            var token = $('input[name=_token]').val();            
            $.ajax({
                url: route + '?userId={{ $datosUsuario->id }}',
                headers:{'X-CSRF-TOKEN':token},
                type: 'delete',
                dataType:"json",
               
                success:function(data){ 
                    if (data.mensaje == 'eliminado') {
                        setTimeout(location.reload(), 1000);
                        alertify.warning('Se eliminó del carrito');                       
                    }else if (data.mensaje == 'error') {
                        alertify.success('Se produjo un error');
                    }
                },
                error:function(data){
                    alertify.success('Se produjo un error');                                                                    
                }
            })
        }, function(){ 
    
        });  
 
    });

    $('#btnGuardar').on('click', function(){
        var cantidad = [];
        var subTotal = [];
        var total;
        var datos;
        var token = $('input[name=_token]').val();

        $("input[name='cantidad[]']").each(function(i){
            cantidad[i] = $(this).val();
        });

        $("input[name='subTotal[]']").each(function(i){
            subTotal[i] = $(this).val();
        });

        total = $('#totalh').val();
        datos = {'cantidad' : cantidad, 'subTotal' : subTotal };

        $.ajax({
            url:'{{ route('saveCart', $productos) }}',
            
            headers:{'X-CSRF-TOKEN':token},
            type: 'POST',
            dataType:"json",
            data:datos,
            success:function(data){
                if (data.mensaje == "guardado") {
                    alertify.warning('Carrito guardado');
                    $('body, html').animate({
                        scrollTop: '0px'
                    }, 300);
                    $('#nav-direccion').tab('show');
                }
            
            },
            error:function(data){
                alertify.success('Se produjo un error');                                                                    
            }
        })                                
    });

    $('#btnGuardar2').on('click', function(e){     
        var token = $('input[name=_token]').val();
        datos = $('#formDireccion').serialize();
        datos += '&userId={{ $datosUsuario->id }}';

        $.ajax({            
            url:'{{ route('saveAddress') }}',         
            headers:{'X-CSRF-TOKEN':token},
            type: 'PATCH',
            dataType:"json",
            data:datos,
            success:function(data){     
                if (data.mensaje == "guardado") {
                    alertify.warning('Dirección guardada');                    
                    $('#nav-pago').tab('show');
                }            
            },
            error:function(data){
                alertify.success('Se produjo un error');                                                                    
            }
        })                                
    });

    function guardarPago(){        
        html2canvas([document.getElementById('sign-pad')], {
            onrendered: function (canvas) {
                var canvas_img_data = canvas.toDataURL('image/png');
                var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");                
                var dataform = $('#formPago').serialize();  
                var token = $('input[name=_token]').val();              
                //ajax call to save image inside folder
                $.ajax({
                    url: '{{ route('procBuy') }}',
                    headers:{'X-CSRF-TOKEN':token},
                    data: { img_data:img_data },
                    type: 'post',
                    dataType: 'json',                   
                    success: function (response) {                      
                       if (response.mensaje == "guardado") { 
                        alertify.warning('Compra realizada <br> Revisa tu email');   
                        window.location = '{{ route('history') }}';
                       }
                    }
                });
            }
        });
    };

    $('#btnPagarCuenta').on('click', function(){
        $('#modalAbono').modal('show');
    });

    $('#btnPagarCuentaFin').on('click', function(){
        $('#modalAbono').modal('hide');
        alertify.warning('Procesando...');
    });

    $(function(){
        paypal.Buttons({
            
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: $('#totalh').val()
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alertify.warning('Procesando...');
                    guardarPago();
                });
            },
             style: {
                layout: 'horizontal'
            }    

            
        }).render('#paypal-button-container');

        $('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90}); 

        $('[data-toggle="tooltip"]').tooltip();

         $('#phone').mask('0000-0000');

        $('.subTotal').each(function() {
            cantidad = parseFloat($(this).parent().siblings('div').find('.cantidad').val());
            precio = parseFloat($(this).parent().siblings('div').find('.precio').val());
            subTotal = cantidad * precio;
            $(this).append(subTotal.toFixed(2));
        });
        $('.subTotalh').each(function() {
            cantidad = parseFloat($(this).parent().siblings('div').find('.cantidad').val());
            precio = parseFloat($(this).parent().siblings('div').find('.precio').val());
            subTotal = cantidad * precio;
            $(this).val(subTotal.toFixed(2));
            
        });
        

        calcularTotal();     
    })

   
</script>
@endsection