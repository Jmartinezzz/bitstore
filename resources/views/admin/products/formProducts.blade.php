{{-- si existen errores --}}
<div id="mensajes-error" class="alert alert-danger alert-dismissible">
	<section class="error"></section>
  	<button type="button" class="close">
  	<span aria-hidden="true">&times;</span>
  </button>
</div>
{{-- si existen errores --}}
<div class="form-group">
	{{ Form::label('productName', 'Nombre:',['class' => 'text-dark']) }}
	{{ Form::text('productName', null, ['class' => 'form-control']) }}
</div>
<div class="row">
	<div class="col-6">
		<div class="form-group">
			{{ Form::label('stock', 'Cantidad Inicial:', ['class' => 'text-dark']) }}
			{{ Form::text('stock', null, ['class' => 'form-control']) }}
		</div>
	</div>
	<div class="col-6">
		<div class="form-group">
			{{ Form::label('category_id', 'Categoria:', ['class' => 'text-dark']) }}
			{{ Form::select('category_id', $categorias,null, ['class' => 'form-control']) }}
		
		</div>
	</div>
</div>
<div class="row">
	<div class="col-6">
		<div class="form-group">
			{{ Form::label('supplier_id', 'Proveedor:',['class' => 'text-dark']) }}
			{{ Form::select('supplier_id', $proveedores,null, ['class' => 'form-control']) }}
		</div>
	</div>
	<div class="col-6">
		<div class="form-group">
			{{ Form::label('price', 'Precio', ['class' => 'text-dark'] )}}
			{{ Form::number('price', null, ['class' => 'form-control', 'min' => '0.50', 'step' => '0.1']) }}
		</div>
	</div>
</div>
<div class="form-group">
	{{ Form::label('description', 'Descripción' ,['class' => 'text-dark']) }}
	{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4']) }}
</div>

