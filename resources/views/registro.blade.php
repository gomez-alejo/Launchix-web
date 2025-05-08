@extends('layout.app')

@section('title', 'Usuario - Launchix')

@section('content')
    @vite([
        'resources/css/registro.css',
    ])

    <!-- Contenedor principal -->
    <div class="">
        <div class="row justify-content-center align-items-center vh-100">
            <!-- Columna para el formulario de registro -->
            <div class="col-md-6">
                <div class="card custom-border">
                    <div class="card-body">
                        <!-- Título del formulario -->
                        <h2 class="text-center text-primary">Registro de Usuario</h2>
                        <!-- Formulario de registro -->
                        <form action="{{ route('register') }}" method="POST" id="registerForm">
                            @csrf
                            <!-- Campo para el nombre -->
                            <div class="form-group">
                                <input type="text" class="form-control custom-border @error('firstName') is-invalid @enderror" id="firstName" name="firstName" placeholder="Nombre" value="{{ old('firstName') }}" required>
                                @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Campo para el apellido -->
                            <div class="form-group">
                                <input type="text" class="form-control custom-border @error('lastName') is-invalid @enderror" id="lastName" name="lastName" placeholder="Apellido" value="{{ old('lastName') }}" required>
                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Campo para el nombre de usuario -->
                            <div class="form-group">
                                <input type="text" class="form-control custom-border @error('username') is-invalid @enderror" id="username" name="username" placeholder="Nombre de usuario" value="{{ old('username') }}" required>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Campo para el correo electrónico -->
                            <div class="form-group">
                                <input type="email" class="form-control custom-border @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Campo para la contraseña -->
                            <div class="form-group">
                                <input type="password" class="form-control custom-border @error('password') is-invalid @enderror" id="password" name="password" placeholder="Contraseña" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Campo para confirmar la contraseña -->
                            <div class="form-group">
                                <input type="password" class="form-control custom-border" id="confirmPassword" name="password_confirmation" placeholder="Confirmar contraseña" required>
                            </div>
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                        </form>
                        <!-- Enlace para iniciar sesión -->
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" id="backToLoginLink" class="text-primary">¿Ya tienes una cuenta? Inicia sesión</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Columna para la imagen de fondo (solo visible en pantallas medianas y grandes) -->
            <div class="col-md-6 d-none d-md-block">
                <img src="https://i.pinimg.com/736x/c3/af/69/c3af6910893aff4662b5150af074bdf9.jpg" alt="Background Image" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
