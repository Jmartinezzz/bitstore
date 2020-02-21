@extends('admin.index')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">			
		  	<div class="card-header">
		    	<h4 class="card-title">Productos</h4>
		    	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#productsModal">Nuevo</button>
		    	<!-- Modal -->
				<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header bg-primary text-white">
				        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        @include('admin.products.formProducts')
				       	{{ Form::label('img', 'Imagénes:', ['class' => 'text-dark'] )}}				       	
				       	<div class="field_wrapper">						    
					        <section class="row">
					        	<div class="col-10">
					        	{{ Form::file('img[]', ['class' => 'form-control bg-light'] )}}						        
					        	</div>
					        	<div class="col-2">
					        		<a href="javascript:void(0);" class="add_button btn-sm btn-outline-primary" title="Agregar"><i class="now-ui-icons ui-1_simple-add"></i></a>
					        	</div>
					        </section>						    
						</div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="button" class="btn btn-primary">Guardar</button>
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
		        				<th>Categoria</th>
		        				<th>Proveedor</th>
		        				<th>Stock</th>
		        				<th>Precio</th>		        						        				
		        				<th>Creación</th>
		        				<th>Acciones</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        		@foreach($products as $prod)
							<tr>
								<td>{{ $prod->productName }}</td>
								<td>{{ $prod->category->name }}</td>
								<td>{{ $prod->supplier->companyName }}</td>
								<td>{{ $prod->stock }}</td>
								<td>{{ $prod->price }}</td>
								<td>{{ $prod->created_at->format('M-d-Y, h:i:s A') }}</td>
								<td></td>
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
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10;
    var addButton = $('.add_button');
    var wrapper = $('.field_wrapper');
    var campoHTML = '<section class="row mt-1">';
    campoHTML +='<div class="col-10">';
    campoHTML += '{{ Form::file('img[]', ['class' => 'form-control bg-light'] )}}';
    campoHTML +='</div>';
    campoHTML +='<div class="col-2">';
    campoHTML +='<a href="javascript:void(0);" class="remove_button btn-sm btn-outline-danger" title="Remover">';
    campoHTML +='<i class="now-ui-icons ui-1_simple-remove"></i>';
    campoHTML +='</a>';
    campoHTML +='</div>';
    campoHTML +='</section>'; 
    var x = 1; 
    $(addButton).click(function(){ 
        if(x < maxField){ 
            x++; 
            $(wrapper).append(campoHTML);
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ 
        e.preventDefault();
        $(this).parents('section').remove(); 
        x--;
    });
});
</script>
@endsection

