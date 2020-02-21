{{-- si existen errores --}}
<div id="mensajes-error" class="alert alert-danger alert-dismissible">
	<section class="error"></section>
  	<button type="button" class="close">
  	<span aria-hidden="true">&times;</span>
  </button>
</div>
{{-- si existen errores --}}
<div class="form-group">
	{{ Form::label('companyName', 'Compañia:',['class' => 'text-dark']) }}
	{{ Form::text('companyName', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('contactName', 'Contacto:',['class' => 'text-dark']) }}
	{{ Form::text('contactName', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('title', 'Cargo:',['class' => 'text-dark']) }}
	{{ Form::text('title', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('email', 'Correo:',['class' => 'text-dark']) }}
	{{ Form::text('email', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('phone', 'Telefono:',['class' => 'text-dark']) }}
	{{ Form::text('phone', null, ['class' => 'form-control']) }}
</div>


