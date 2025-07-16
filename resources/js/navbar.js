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
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        const notificationCount = document.getElementById('notificationCount');
        const notificationMenu = document.getElementById('notificationMenu');

        if (notificationCount && notificationMenu) {
            notificationCount.textContent = data.unreadCount ?? 0;
            notificationMenu.innerHTML = '';

            if (Array.isArray(data.notificaciones)) {
                if (data.notificaciones.length === 0) {
                    // Mostrar mensaje amigable si no hay notificaciones
                    const emptyMsg = document.createElement('div');
                    emptyMsg.className = 'dropdown-item text-center';
                    emptyMsg.innerHTML = '<i class="fas fa-bell-slash fa-2x text-muted"></i><br><span class="text-muted">No tienes notificaciones por el momento</span>';
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
            } else {
                // Si la respuesta no tiene la estructura esperada, mostrar error
                const errorMsg = document.createElement('div');
                errorMsg.className = 'dropdown-item text-center text-danger';
                errorMsg.textContent = 'Error al cargar las notificaciones.';
                notificationMenu.appendChild(errorMsg);
            }
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