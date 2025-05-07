@extends('layout.app')

@section('title', 'Usuario - Launchix')

@section('content')
    @vite(['resources/css/usuario.css'])

    <!-- Contenido principal de la página -->
    <div class="container mt-5 pt-5 my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="cover-pic-container">
                    <img id="coverPic" src="https://via.placeholder.com/750x300" alt="Foto de portada" class="img-fluid">
                    <input type="file" id="coverPicInput" class="d-none">
                    <div class="camera-icon" id="coverCameraIcon"><i class="fas fa-camera"></i></div>
                    <div class="profile-pic-container">
                        <img id="profilePic" src="https://via.placeholder.com/150" alt="Foto de perfil" class="img-fluid rounded-circle">
                        <input type="file" id="profilePicInput" class="d-none">
                        <div class="camera-icon" id="profileCameraIcon"><i class="fas fa-camera"></i></div>
                    </div>
                </div>
                <h3 id="profileName">{{ $user->username }}</h3>
                <p id="profileDescription">{{ $user->description }}</p>

                <!-- Contenedor para los botones -->
                <div class="button-container mt-4 d-flex justify-content-between align-items-center">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Editar Perfil</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#userDataModal">Datos de Usuario</button>
                        <button type="button" class="btn btn-outline-secondary">Publicaciones</button>
                    </div>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#blogModal">Publicar Blogs</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensajes de éxito y error -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Modal para Editar Perfil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="userDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="userDescription" name="userDescription" placeholder="Introduce una breve descripción">{{ $user->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Datos de Usuario -->
    <div class="modal fade" id="userDataModal" tabindex="-1" aria-labelledby="userDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDataModalLabel">Datos de Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserDataForm" action="{{ route('user-data.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="firstName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $user->firstName }}">
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Modal para Publicar Blogs -->
<div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blogModalLabel">Publicar Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="blogForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido</label>
                        <textarea class="form-control" id="content" name="content" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image_path" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="image_path" name="image_path">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoría</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuario</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="@vite(['resources/js/usuario.js'])"></script>

@endsection

