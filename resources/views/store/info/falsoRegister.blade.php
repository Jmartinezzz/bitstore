@extends('layouts.app')
@section('accion', 'Votación - Registro')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('falsoStore') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cif" class="col-md-4 col-form-label text-md-right">Numero de CIF</label>

                            <div class="col-md-6">
                                <input id="cif" type="text" class="form-control"  name="cif" required autocomplete="cif" autofocus>                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">                               
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    Registrarme
                                </button>
                                <a class="ml-5" href="{{ route('falsoLogin') }}">Acceso</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
