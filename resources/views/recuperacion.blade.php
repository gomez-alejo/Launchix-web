@extends('layout.app')

@section('title', 'Usuario - Launchix')

@section('content')
@vite([
    'resources/css/recuperacion.css',
])
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-body">
                    <h2 class="text-center text-primary">Recuperar Contraseña</h2>
                    <form id="recoverForm">
                        <div class="form-group">
                            <input type="email" class="form-control custom-border" id="email" placeholder="Correo electrónico" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Enviar Enlace de Recuperación</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ url('/login') }}" id="backToLoginLink" class="text-primary">Volver al Inicio de Sesión</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-none d-md-block">
            <img src="https://i.pinimg.com/736x/c3/af/69/c3af6910893aff4662b5150af074bdf9.jpg" alt="Background Image" class="img-fluid">
        </div>
    </div>
</div>
@endsection