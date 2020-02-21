{{-- si existen errores --}}
<div id="mensajes-error" class="alert alert-danger alert-dismissible">
	<section class="error"></section>
  	<button type="button" class="close">
  	<span aria-hidden="true">&times;</span>
  </button>
</div>
{{-- si existen errores --}}
<div class="form-group">
	{{ Form::label('name', 'Nombre:',['class' => 'text-dark']) }}
	{{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('description', 'Descripción' ,['class' => 'text-dark']) }}
	{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) }}
</div>

