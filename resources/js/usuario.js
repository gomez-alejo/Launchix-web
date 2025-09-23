// resources/js/usuario.js

document.addEventListener('DOMContentLoaded', function () {
    // Elementos del DOM
    const coverPicInput = document.getElementById('coverPicInput');
    const coverCameraIcon = document.getElementById('coverCameraIcon');
    const coverPic = document.getElementById('coverPic');

    const profilePicInput = document.getElementById('profilePicInput');
    const profileCameraIcon = document.getElementById('profileCameraIcon');
    const profilePic = document.getElementById('profilePic');

    // Evento para cambiar la foto de portada
    coverCameraIcon.addEventListener('click', function () {
        // Al hacer click en el icono, abre el selector de archivos
        coverPicInput.click();
    });

    coverPicInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            // Muestra la imagen seleccionada de inmediato (previsualización)
            const reader = new FileReader();
            reader.onload = function (e) {
                coverPic.src = e.target.result;
            };
            reader.readAsDataURL(file);
            // Envía el formulario para subir la imagen al backend
            document.getElementById('coverPicForm').submit();
        }
    });

    // Evento para cambiar la foto de perfil
    profileCameraIcon.addEventListener('click', function () {
        // Al hacer click en el icono, abre el selector de archivos
        profilePicInput.click();
    });

    profilePicInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            // Muestra la imagen seleccionada de inmediato (previsualización)
            const reader = new FileReader();
            reader.onload = function (e) {
                profilePic.src = e.target.result;
            };
            reader.readAsDataURL(file);
            // Envía el formulario para subir la imagen al backend
            document.getElementById('profilePicForm').submit();
        }
    });
});
