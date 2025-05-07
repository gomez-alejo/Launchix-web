@extends('layout.app')

@section('title', 'Iniciar Sesión - Launchix')

@section('content')
    @vite(['resources/css/login.css', 'resources/css/style.css'])

    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="card custom-border">
                <div class="card-body">
                    <h2 class="text-center text-primary">Iniciar Sesión</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control custom-border @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control custom-border @error('password') is-invalid @enderror" id="password" name="password" placeholder="Contraseña" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('recuperacion') }}" id="forgotPasswordLink" class="text-primary">¿Olvidó su contraseña?</a>
                    </div>
                    <div class="text-center mt-2">
                        <a href="{{ route('register.form') }}" id="registerLink" class="text-primary">¿No tiene una cuenta? Regístrese</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-none d-md-block">
            <img src="https://i.pinimg.com/736x/c3/af/69/c3af6910893aff4662b5150af074bdf9.jpg" alt="Background Image" class="img-fluid">
        </div>
    </div>
@endsection
