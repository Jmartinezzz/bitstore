@extends('store.partials.principal')
@section('title',"Mi cuenta")
<!-- @section('activeUser',"active") -->
@section('headerScripts')
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.31.0/css/jquery.fileupload.min.css"> -->
    <style>
        .profile-pic {
            width: 225px;
            height: 225px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }
        .profile-pic img {
            object-fit: cover;
        }
        .file-upload {
            display: none;
        }
    </style>
@endsection
@section('content')
<!-- contenido -->
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-10 ">
            <div class="card text-center">
                <div class="card-header bg-warning text-white">
                    <h4>Administra tu cuenta</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <form id="uploadPicForm" enctype="multipart/form-data">
                                @csrf
                                <div class="profile-pic border border-warning p-1" onclick="document.getElementById('file-upload').click();">
                                    <img id="img" class="rounded-circle w-100 h-100" src="{{ $user->avatar_url }}" alt="User Avatar">
                                </div>
                                <input id="file-upload" class="file-upload" type="file" name="img">
                            </form>
                            
                        </div>
                    </div>
                    <form id="updateProfileForm">
                        @csrf
                        <div class="row my-3">
                            <div class="col-6">
                                <div class="form-group row align-items-end">
                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">Nombre/s:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row align-items-end">
                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">Apellido/s:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lastName" value="{{ $user->lastName }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row align-items-end">
                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">Correo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row align-items-end">
                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">Genero:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="gender">
                                        <option value="" {{ !$user->gender ? 'selected' : '' }}>Selecciona...</option>
                                        <option value="m" {{ $user->gender == 'm' ? 'selected' : '' }}>Masculino</option>
                                        <option value="f" {{ $user->gender == 'f' ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 offset-3 mt-3">
                                <button id="btnSaveProfile" class="btn btn-lg btn-warning">Guardar <i class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </form>
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
    $('#btnSaveProfile').on('click', function(){
        let data = $('#updateProfileForm').serialize()
        let token = $('input[name=_token]').val();
        data += '&userId={{ $user->id }}';

        $.ajax({
            url: '{{ route('account.update', $user) }}',
            headers:{'X-CSRF-TOKEN':token},
            type: 'PATCH',
            dataType:"json",
            data:data,
            beforeSend: function( xhr ) { 
                $('#btnSaveProfile').text('Guardando ');
                $('#btnSaveProfile').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                
                $('#btnSaveProfile').attr('disabled', 'disabled');
            },
            success:function(data){     
                if (data.mensaje = "actualizado") {
                    setTimeout(function() {
                        $('#btnSaveProfile').text('Guardar ');
                        $('#btnSaveProfile').append('<i class="fas fa-save"></i>');
                        $('#btnSaveProfile').removeAttr('disabled');
                        alertify.warning('Datos actualizados con Éxito');
                    }, 1200)
                }
            },
            error:function(data){
                var errores = "¡Atención!";                        
                if (data.responseJSON.errors) {
                    $.each(data.responseJSON.errors, function(i, valor){
                        errores += "<li>" +valor + "</li>";
                    });                       
                    alertify.success(errores);
                    $('#btnSaveProfile').removeAttr('disabled');
                    $('#btnSaveProfile').text('GUARDAR');
                    $('#btnSaveProfile').append('<i class="fas fa-save"></i>');
                }                                                                    
            }
        })
    });

    $('#file-upload').on('change', function(e) {
        let formData = new FormData();
        let token = $('input[name=_token]').val();
        formData.append('img', $('#file-upload')[0].files[0]);

        $.ajax({
            url: '{{ route('account.update.img', $user) }}',
            type: 'POST',
            data: formData,
            headers:{'X-CSRF-TOKEN':token},
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.mensaje == 'actualizado') {
                    $('#file-upload').val('')
                    $('#img').fadeOut(500, function() {
                        $('#img').attr('src', response.newAvatarPath);
                    })                   
                    $('#img').fadeIn(500)
                    alertify.warning('Imagen actualizada con Éxito');
                }
            },
            error: function(data) {
                var errores = "¡Atención!";                        
                if (data.responseJSON.errors) {
                    $.each(data.responseJSON.errors, function(i, valor){
                        errores += "<li>" +valor + "</li>";
                    });
                    $('#file-upload').val('')    
                    alertify.success(errores);
                }
            }
        });
    });
   
</script>
@endsection