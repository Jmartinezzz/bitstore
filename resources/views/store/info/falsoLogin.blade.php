@extends('layouts.app')
@section('accion', 'Votación - Acceso')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('votacion') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cif" class="col-md-4 col-form-label text-md-right">CIF:</label>

                            <div class="col-md-6">
                                <input id="cif" type="text" class="form-control" name="cif" required  autofocus>
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">                               
                            </div>
                        </div>                      
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Login') }}
                                </button>  
                                <a class="ml-5" href="{{ route('falsoRegister') }}">Registrarme</a>                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (session('mensaje'))
                <div class="alert alert-danger alert-dismissible fade show w-100 mt-3" role="alert">
                   {{ session('mensaje') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
