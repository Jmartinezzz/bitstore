@extends('admin.index')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">			
		  	<div class="card-header">
		    	<h4 class="card-title">Categorías</h4>
		    	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#categoryModal">Nuevo</button>
		    	<!-- Modal -->
				<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header bg-primary text-white">
				        <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	{!! Form::open(['route' => 'categories.store', 'method' => 'post', 'id' => 'formAddCategory']) !!}
				        	@include('admin.categories.formCategories')	
				        		       					      
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <input type="button" id="btnStoreCategory" class="btn btn-primary" value="Guardar">
				        {!! Form::close() !!}	
				      </div>
				    </div>
				  </div>
				</div>	<!-- Modal -->
		  	</div>
		  	<div class="card-body">
		    	<div class="table-responsive">
		      		<table class="table">		      	
		        		<thead class="text-primary">		          
		        			<tr>
		        				<th>Nombre</th>
		        				<th>Descripción</th>
		        				<th>Creación</th>
		        				<th>Acciones</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        		@foreach($categories as $cate)
							<tr>
								<td>{{ $cate->name }}</td>
								<td>{{ $cate->description }}</td>
								<td>{{ $cate->created_at->format('M-d-Y, h:i:s A') }}</td>
								<td>
								{{ Form::open(['route' => ['categories.destroy',$cate->id] ,'method' => 'delete', 'class' => 'd-inline']) }}
									<button type="subnit" class="btn btn-outline-primary btn-sm btn-eliminar" title="Eliminar">
										<span class="icon-trash"></span>
									</button>
								{{ Form::close() }}	
								</td>
							</tr>
						@endforeach
		        		</tbody>
		      		</table>
		    	</div>
		  	</div>
		</div>
	</div>		
</div>
@endsection
@section('scriptsFooter')
<script>
	$(function(){
		$('#mensajes-error').hide();

		//agregar y mostrar errores de validacion en formulario de ingreso de usuarios
			$('#btnStoreCategory').on('click', function(){
			  	var data = $('#formAddCategory').serialize();			  
			  	var token = $('input[name=_token]').val();
			  	var route = "{{ route('categories.store') }}"; 			  	

			  	$.ajax({
			  		url: route,
			  		headers:{'X-CSRF-TOKEN':token},
			  		type: 'POST',
			  		dataType:"json",
			  		data:data,
			  		success:function(data){		
			  			$('#categoryModal').modal('hide');	  					  		  				
		  				location.href="{{  route('categories.index') }}";
			  		},
			  		error:function(data){ 			  		
			  			$('.close').on('click', function(){
			  				$('#mensajes-error').hide();
			  			});

			  			var errores="";

			  			if(typeof data.responseJSON !== 'undefined'){
			  				$.each(data.responseJSON.errors, function(i, valor){
				  				errores += "<li>" +valor + "</li>";
				  			});

				  			$('#mensajes-error').show();			  			
				  			
				  			$('.error').html(errores);
			  			}			  		
			  		},
			  	})
		  	});
		   //agregar y mostrar errores de validacion en formulario de ingreso de usuarios
	})
</script>
@endsection
