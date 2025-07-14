<header>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <!-- Logo y nombre de la marca -->
            <a class="navbar-brand" href="#">
                <i class="fas fa-store"></i> Launchix
            </a>
            <!-- Botón para alternar la navegación en dispositivos móviles -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Contenido de la barra de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Enlaces de navegación principales -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/launchix') }}"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('emprendimiento') }}"><i class="fas fa-lightbulb"></i> Emprendimiento</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('blogs') }}"><i class="fas fa-blog"></i> Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq"><i class="fas fa-question-circle"></i> FAQ</a></li>
                </ul>
                <!-- Enlaces de navegación para el usuario -->
                <ul class="navbar-nav">
                    @if(Auth::check())
                    <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <span class="badge badge-danger" id="notificationCount">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" id="notificationMenu">
                                <!-- Las notificaciones se cargarán aquí -->
                            </div>
                        </li>
                        <!-- Menú desplegable para el perfil del usuario -->
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
                                <!-- Formulario oculto para cerrar sesión -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <!-- Enlace para iniciar sesión o registrarse -->
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}"><i class="fas fa-user"></i> Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}"><i class="fas fa-user"></i> registrarse</a></li>
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
                <!-- Opciones de configuración -->
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
    // Función para confirmar la eliminación de la cuenta
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
    // Función para cargar notificaciones
    function cargarNotificaciones() {
        fetch('/notificaciones', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })      
        .then(response => response.json())
        .then(data => {
            const notificationCount = document.getElementById('notificationCount');
            const notificationMenu = document.getElementById('notificationMenu');

            notificationCount.textContent = data.unreadCount;
            notificationMenu.innerHTML = '';

            if (data.notificaciones.length === 0) {
                // Si no hay notificaciones, mostrar mensaje
                const emptyMsg = document.createElement('div');
                emptyMsg.className = 'dropdown-item text-center text-muted';
                emptyMsg.textContent = 'No tienes notificaciones por el momento';
                notificationMenu.appendChild(emptyMsg);
            } else {
                data.notificaciones.forEach(notificacion => {
                    const notificationItem = document.createElement('a');
                    notificationItem.className = 'dropdown-item';
                    notificationItem.href = notificacion.url;
                    notificationItem.textContent = notificacion.message;
                    notificationMenu.appendChild(notificationItem);
                });
            }
        })
        .catch(error => console.error('Error al cargar las notificaciones:', error));
    }

    // Cargar notificaciones al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        cargarNotificaciones();

        // Actualizar notificaciones cada 30 segundos
        setInterval(cargarNotificaciones, 30000);
    });
</script>
