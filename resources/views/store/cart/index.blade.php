@extends('store.partials.principal')
@section('title',"Carrito de compras")
@section('content')
<!-- contenido -->
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
                                    <a class="nav-item nav-link col-md-4" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"><h6>Pago</h6></a>
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
                                                    <img src="{{ asset('img/productos/' . $imge->img) }}" class="card-img-top" style="width: 220px; height: 200px">
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
                                            <form>
                                                <div class="row">
                                                    <div class="col">
                                                    <input type="text" class="form-control" placeholder="Nombre">
                                                    </div>
                                                    <div class="col">
                                                    <input type="text" class="form-control" placeholder="Apellido">
                                                    </div>                                                        
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <textarea class="form-control" placeholder="Dirección" name="" id="" rows="2"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                    <input type="text" class="form-control" placeholder="Ciudad">
                                                    </div>
                                                    <div class="col">
                                                    <input type="text" class="form-control" placeholder="Telefono">
                                                    </div>                                                        
                                                </div>
                                            </form>
                                        </div>        
                                    </div> 
                                    <div class="row justify-content-end">
                                        <div class="col-md-2">
                                             <div class="form-group">                        
                                                <form class="d-inline">
                                                    @csrf                                               
                                                    <button type="button" id="btnGuardar2" class="btn btn-sm btn-warning">Guardar y continuar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>                                     
                                </div><!-- nav 2 (dirección) -->

                                <!-- nav 3 (payment) -->
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="row my-3">                                                
                                        <div class="col-12">
                                            <form>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="Número de tarjeta">
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" class="form-control" placeholder="MM/YY">
                                                    </div>  
                                                    <div class="col-2">
                                                        <input type="text" class="form-control" placeholder="CVV">
                                                    </div>                                                       
                                                </div>                                                        
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="Nombre del tarjeta habiente">
                                                    </div>                                    
                                                </div>
                                                <div class="row mt-2 justify-content-end">
                                                    <div class="col-3">
                                                        <button class="btn btn-outline-warning"><i class="fas fa-credit-card"></i> Pagar</button>
                                                        <button class="btn btn-outline-dark"><i class="fas fa-cancel"></i> cancelar</button>
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
<script>   
    var cantidad;
    var precio;
    var subTotal;
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
        // $(this).parents('form:first').submit();
        var route = $(this).parents('form').attr('action');
        console.log(route); 
        alertify.confirm('Eliminar del carrito', '¿Estàs seguro de eliminar del carrito?', function(){ 
                      
            var token = $('input[name=_token]').val();            
            $.ajax({
                url: route,
                headers:{'X-CSRF-TOKEN':token},
                type: 'delete',
                dataType:"json",
               
                success:function(data){ 
                 console.log(data);    
                    if (data.mensaje == 'eliminado') {
                        setTimeout(location.reload(), 1000);
                        alertify.warning('Se eliminó del carrito');                       
                    }else if (data.mensaje == 'error') {
                        alertify.success('Se produjo un error');
                    }
                },
                error:function(data){
                    console.log(data);                    
                    alertify.success('Se produjo un error');                                                                    
                }
            })
             // $(this).parents('form:first').submit();
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

        datos = {'cantidad' : cantidad, 'subTotal' : subTotal, 'total' : total };

        $.ajax({
            
            url:'{{ route('saveCart', $productos) }}',                 
            
            headers:{'X-CSRF-TOKEN':token},
            type: 'POST',
            dataType:"json",
            data:datos,
            success:function(data){     
               console.log(data);
                if (data.mensaje == "guardado") {
                    alertify.warning('Carrito guardado');
                    $('body, html').animate({
                        scrollTop: '0px'
                    }, 300);
                    $('#nav-direccion').tab('show');
                }
            
            },
            error:function(data){
                console.log(data);
                alertify.success('Se produjo un error');                                                                    
            }
        })                                

    });

    $(function(){
        $('[data-toggle="tooltip"]').tooltip();



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