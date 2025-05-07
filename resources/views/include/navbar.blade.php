<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-store"></i> Launchix
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/launchix') }}"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('emprendimiento') }}"><i class="fas fa-lightbulb"></i> Emprendimiento</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('blog') }}"><i class="fas fa-blog"></i> Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq"><i class="fas fa-question-circle"></i> FAQ</a></li>
                </ul>
                <ul class="navbar-nav">
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->username }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ url('/usuario') }}"><i class="fas fa-user-circle"></i> Perfil</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#configModal"><i class="fas fa-cog"></i> Configuración</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}"><i class="fas fa-user"></i> Iniciar Sesión / Registro</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Modal de Configuración -->
<div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="configModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="configModalLabel">Configuración</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <a href="{{ url('/soporte-tecnico') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-headset"></i> Soporte Técnico
                    </a>
                    <a href="#" onclick="cambiarTema()" class="list-group-item list-group-item-action">
                        <i class="fas fa-moon"></i> Cambiar a Tema Oscuro
                    </a>
                    <a href="#" onclick="confirmarEliminarCuenta(event)" class="list-group-item list-group-item-action">
                        <i class="fas fa-trash-alt"></i> Eliminar Cuenta
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Mensaje de éxito -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

    
@endif

<script>
    function confirmarEliminarCuenta(event) {
    event.preventDefault();
    if (confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')) {
        // Crear un formulario dinámico para enviar la solicitud DELETE
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/eliminar-cuenta';
        form.style.display = 'none';

        // Añadir el token CSRF
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Añadir el campo para el método DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        // Añadir el formulario al cuerpo del documento y enviarlo
        document.body.appendChild(form);
        form.submit();
    }
}
</script>