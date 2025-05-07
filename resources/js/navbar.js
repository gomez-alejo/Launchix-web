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