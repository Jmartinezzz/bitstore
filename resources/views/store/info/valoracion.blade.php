@include('store.partials.header')
@section('title', "Votación")

<main>
	<div class="container my-4">
		<h5 class="font-weight-normal text-right">{{  $usuario->cif }}</h5>
		<a href="{{ route('falsoLogin') }}"><h5 class="font-weight-normal text-right">Salir</h5></a>
		<h1 class="font-weight-normal text-center">Valora nuestros artículos</h1>
		<div class="row">
			@foreach ($productos as $producto)
			<div class="col-md-4 mt-3">
	        	<div class="card border-warning mb-3">
		          <div class="card-body text-center">
		            <h5 class="card-title">{{ $producto->productName }}</h5>
		            @foreach ($producto->images as $imge)
                    <a href="{{ route('product.detail', $producto) }}">
                       <img src="{{ asset('img/productos/' . $imge->img) }}" class="card-img-top img-fluid" style="width: 100%; height: 300px"> 
                    </a>                        
                    @break
                    @endforeach 		                     
		          </div>
		          <div class="card-footer bg-transparent text-center">
		            <form style="display: inline;">
		            	<input type="hidden" class="productID" value="{{ $producto->id }}">
		            	<button type="button"  class="btn btn-outline-warning btn-sm gusta" data-toggle="tooltip" title="Me gusta">
		            	<i class="fas fa-thumbs-up fa-2x"></i> ({{ $producto->gusta }})
		            </button>	
		            </form>	
		          {{--  <form style="display: inline;">
		           			           	
		           		<input type="hidden" class="prodID" value="{{ $producto->id }}">                  
		            	<button type="button"  class="btn btn-outline-warning btn-sm noGusta" data-toggle="tooltip" title="No me gusta">
		            	<i class="fas fa-thumbs-down fa-lg"></i> ({{ $producto->noGusta }})
		            </button>
		           </form>	 --}}	                  
		          </div>
	        	</div>
	        </div>
			@endforeach
		</div>
		<h4 class="font-weight-normal text-center my-5">Dale me gusta al producto que más te guste, solo cuenta un voto por usuario.</h4>
	</div>
</main>

@include('store.partials.footer')

<script>
	$(function(){
		 $('[data-toggle="tooltip"]').tooltip();     
	});

	$('.gusta').on('click', function(){
		id = $(this).siblings('.productID').val();		
		idUsuario = '{{ $usuario->cif }}'
		if (sessionStorage.getItem('valoracion'+idUsuario) == 1) {
			alertify.warning('Ya tenemos tu Valoración');
		}else{
			var token = $('input[name=_token]').val(); 
				
			$.post({
				url: '/votacion/sumar/' + id,
	            headers:{'X-CSRF-TOKEN':token},            
	            dataType:"json",                        
	            success:function(data){ 	            	
	                if (data.mensaje = "votado") {
	                    alertify.warning('Gracias por tu Valoración');
	                    sessionStorage.setItem('valoracion'+idUsuario, '1')
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
			});
		}
		
	});

	$('.noGusta').on('click', function(){
		var tokens = $('input[name=_token]').val(); 
		let id = $(this).siblings('.prodID').val();	
		if (sessionStorage.getItem('valoracion'+id) == 1) {
			alertify.warning('Ya tenemos tu Valoración');
		}else{
			$.post({
				url: '/votacion/restar/' + id,
	            headers:{'X-CSRF-TOKEN':tokens},            
	            dataType:"json",                        
	            success:function(data){     
	                if (data.mensaje = "votado") {
	                    alertify.warning('Gracias por tu Valoración');
	                    sessionStorage.setItem('valoracion'+id, '1')
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
	                }                                                                    
	            }
			});
		}	
		
	});
</script>

