@extends('layout.app')

@section('title', 'Usuario - Launchix')

@section('content')
    @vite(['resources/css/usuario.css'])


    <!-- Contenido principal de la página -->
    <div class="container mt-5 pt-5 my-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Contenedor para la foto de portada y perfil -->
                <div class="cover-pic-container">
                    <!-- Foto de portada: muestra la imagen guardada o un placeholder -->
                    <img id="coverPic" src="{{ $user->cover_picture ? asset('storage/' . $user->cover_picture) : 'https://via.placeholder.com/750x300' }}" alt="Foto de portada" class="img-fluid">
                    <!-- Formulario oculto para subir la foto de portada -->
                    <form id="coverPicForm" action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                        @csrf
                        <input type="file" id="coverPicInput" name="coverPic" accept="image/*">
                    </form>
                    <!-- Icono de cámara para seleccionar la foto de portada -->
                    <div class="camera-icon" id="coverCameraIcon"><i class="fas fa-camera"></i></div>
                    <div class="profile-pic-container">
                        <!-- Foto de perfil: muestra la imagen guardada o un placeholder -->
                        <img id="profilePic" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}" alt="Foto de perfil" class="img-fluid rounded-circle">
                        <!-- Formulario oculto para subir la foto de perfil -->
                        <form id="profilePicForm" action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                            @csrf
                            <input type="file" id="profilePicInput" name="profilePic" accept="image/*">
                        </form>
                        <!-- Icono de cámara para seleccionar la foto de perfil -->
                        <div class="camera-icon" id="profileCameraIcon"><i class="fas fa-camera"></i></div>
                    </div>
                </div>
                <!-- Nombre de usuario -->
                <h3 id="profileName">{{ $user->username }}</h3>
                <!-- Descripción del usuario -->
                <p id="profileDescription">{{ $user->description }}</p>

                <!-- Contenedor para los botones -->
                <div class="button-container mt-4 d-flex justify-content-between align-items-center">
                    <div class="btn-group" role="group">
                        <!-- Botón para editar perfil -->
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Editar Perfil</button>
                        <!-- Botón para ver datos de usuario -->
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#userDataModal">Datos de Usuario</button>
                        <!-- Botón para ver publicaciones -->
                        <button type="button" id="showBlogsButton" class="btn btn-outline-secondary">Publicaciones</button>
                    </div>
                    <!-- Botón para publicar blogs -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#blogModal">Publicar Blogs</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenedor oculto para los blogs -->
    <div id="blogsContainer" class="mt-4" style="display: none;">
        <!-- Contenido de los blogs del usuario -->
        @if(isset($blogs) && count($blogs) > 0)
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-end">
                                <!-- Botón de opciones en la parte superior de la tarjeta -->
                                <button type="button" class="btn btn-link text-dark" data-bs-toggle="modal" data-bs-target="#optionsModal{{ $blog->id }}">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                            <div class="card-img-container">
                                @if($blog->image_path)
                                    <img src="{{ asset($blog->image_path) }}" class="card-img-top" alt="{{ $blog->title }}">
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                                <span class="badge badge-primary">{{ strtolower($blog->category->name) }}</span>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#commentsModal{{ $blog->id }}">
                                        <i class="fas fa-comment"></i> Comentarios
                                    </button>
                                    <button class="btn btn-link like-button" data-blog-id="{{ $blog->id }}">
                                        <i class="fas fa-thumbs-up"></i> Me gusta
                                    </button>
                                </div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#blogModal{{ $blog->id }}">Leer más</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de Opciones -->
                    <div class="modal fade" id="optionsModal{{ $blog->id }}" tabindex="-1" aria-labelledby="optionsModalLabel{{ $blog->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optionsModalLabel{{ $blog->id }}">Opciones de Blog</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario de Edición -->
                                    <form id="blogForm{{ $blog->id }}" action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Título</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Contenido</label>
                                            <textarea class="form-control" id="content" name="content" required>{{ $blog->content }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image_path" class="form-label">Imagen</label>
                                            <input type="file" class="form-control" id="image_path" name="image_path">
                                            @if($blog->image_path)
                                                <img src="{{ asset($blog->image_path) }}" alt="{{ $blog->title }}" class="img-thumbnail mt-2" width="150">
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Categoría</label>
                                            <select class="form-control" id="category_id" name="category_id" required>
                                                <option value="">Seleccione una categoría</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">Usuario</label>
                                            <select class="form-control" id="user_id" name="user_id" required>
                                                <option value="{{ $blog->user_id }}">{{ $blog->user->username }}</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <!-- Botón de Eliminar -->
                                    <form id="deleteForm{{ $blog->id }}" action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $blog->id }})">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Blog -->
                    <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel{{ $blog->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="blogModalLabel{{ $blog->id }}">{{ $blog->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $blog->content }}</p>
                                    <!-- Sistema de calificación -->
                                    <div class="rating">
                                        <input type="radio" id="star5-{{ $blog->id }}" name="rating-{{ $blog->id }}" value="5" />
                                        <label for="star5-{{ $blog->id }}">★</label>
                                        <input type="radio" id="star4-{{ $blog->id }}" name="rating-{{ $blog->id }}" value="4" />
                                        <label for="star4-{{ $blog->id }}">★</label>
                                        <input type="radio" id="star3-{{ $blog->id }}" name="rating-{{ $blog->id }}" value="3" />
                                        <label for="star3-{{ $blog->id }}">★</label>
                                        <input type="radio" id="star2-{{ $blog->id }}" name="rating-{{ $blog->id }}" value="2" />
                                        <label for="star2-{{ $blog->id }}">★</label>
                                        <input type="radio" id="star1-{{ $blog->id }}" name="rating-{{ $blog->id }}" value="1" />
                                        <label for="star1-{{ $blog->id }}">★</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Comentarios -->
                    <div class="modal fade" id="commentsModal{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel{{ $blog->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentsModalLabel{{ $blog->id }}">Comentarios</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Lista de comentarios -->
                                    <div class="comments-list">
                                        @foreach($blog->comments as $comment)
                                            <div class="comment">
                                                <p>{{ $comment->content }}</p>
                                                <div class="d-flex justify-content-end">
                                                    <button onclick="editComment({{ $comment->id }}, '{{ $comment->content }}')" class="btn btn-sm btn-primary edit-comment">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </button>
                                                    <button onclick="deleteComment({{ $comment->id }})" class="btn btn-sm btn-danger delete-comment">
                                                        <i class="fas fa-trash-alt"></i> Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Sección para añadir comentarios -->
                                    <div class="comment-section">
                                        <form action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                            <textarea class="form-control" rows="2" name="content" placeholder="Añadir un comentario..."></textarea>
                                            <button type="submit" class="btn btn-sm btn-primary mt-2">Comentar</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No hay blogs disponibles.</p>
        @endif
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
                    <!-- Formulario para editar perfil -->
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
                    <!-- Formulario para editar datos de usuario -->
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
                    <!-- Formulario para publicar blogs -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('showBlogsButton').addEventListener('click', function() {
        var blogsContainer = document.getElementById('blogsContainer');
        if (blogsContainer.style.display === 'none') {
            blogsContainer.style.display = 'block';
        } else {
            blogsContainer.style.display = 'none';
        }
    });

    function confirmDelete(blogId) {
        if (confirm("¿Estás seguro de que deseas eliminar este blog?")) {
            document.getElementById('deleteForm' + blogId).submit();
        }
    }

    function editComment(commentId, commentContent) {
        let newContent = prompt("Edita tu comentario:", commentContent);
        if (newContent !== null) {
            fetch(`/comments/${commentId}/update`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ content: newContent })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function deleteComment(commentId) {
        if (confirm("¿Estás seguro de que deseas eliminar este comentario?")) {
            fetch(`/comments/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Función para manejar los "me gusta"
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', function() {
                const blogId = this.getAttribute('data-blog-id');
                this.classList.toggle('liked');
                alert('Me gusta en el blog: ' + blogId);
            });
        });
    });
</script>
@endsection
