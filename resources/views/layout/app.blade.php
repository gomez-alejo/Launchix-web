<!-- resources/views/layout/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Launchix - Plataforma de Oportunidades para Emprendedores en Timbío">
    <meta name="keywords" content="Launchix, emprendimiento, Timbío, plataforma, oportunidades">
    <title>@yield('title', 'Launchix - Plataforma de Oportunidades')</title>
    @include('include.links')


    <!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>
<body>
    @include('include.navbar')

    <main class="container mt-5" >
        @yield('content')
    </main>

    @include('include.footer')
    @include('include.scripts')

</body>
</html>

