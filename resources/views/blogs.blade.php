    @extends('layout.app')

    @section('title', 'Página Principal')

    @section('content')
    <style>
        /* Estilos para el contenedor de blogs */
        .blog-container {
            margin-top: 30px;
        }
        /* Estilos para las tarjetas de blogs */
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 600px; /* Altura fija para las tarjetas */
            display: flex;
            flex-direction: column;
        }
        /* Estilos para el contenedor de búsqueda */
        .search-container {
            margin-bottom: 20px;
        }
        /* Estilos para el sistema de calificación */
        .rating {
            display: inline-block;
            unicode-bidi: bidi-override;
            direction: rtl;
        }
        .rating > input {
            display: none;
        }
        .rating > label {
            display: inline-block;
            font-size: 20px;
            color: #ccc;
            cursor: pointer;
        }
        .rating > input:checked ~ label,
        .rating > input:checked ~ label ~ label {
            color: #7597c9;
        }
        .rating > label:hover,
        .rating > label:hover ~ label {
            color: #166ff4;
        }
        /* Estilos para la sección de comentarios */
        .comment-section {
            margin-top: 20px;
        }
        /* Estilos para la lista de comentarios */
        .comments-list {
            margin-top: 20px;
        }
        /* Estilos para cada comentario */
        .comment {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        /* Estilos para el título de la tarjeta */
        .card-title {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        /* Estilos para el texto de la tarjeta */
        .card-text {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        /* Estilos para el título del modal */
        .modal-title {
            word-wrap: break-word;
            white-space: normal;
        }
        /* Estilos para el cuerpo del modal */
        .modal-body p {
            word-wrap: break-word;
            white-space: normal;
        }
        /* Estilos para el botón de "me gusta" */
        .like-button i, .btn-link i {
            margin-right: 5px;
        }
        .like-button {
            color: #ccc;
            cursor: pointer;
        }
        .like-button.liked {
            color: #166ff4;
        }
        .like-button:hover {
            color: #166ff4;
        }
        /* Estilos para los botones de editar y eliminar comentarios */
        .edit-comment, .delete-comment {
            margin-left: 10px;
        }
        .edit-comment i, .delete-comment i {
            margin-right: 5px;
        }
        /* Estilos para el contenedor de la imagen */
        .card-img-container {
            height: 250px; /* Aumentar la altura del contenedor de la imagen */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .card-img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .highlight-blog {
            border: 3px solid #41cdf4 !important;
            background: #87d4f5 !important;
            box-shadow: 0 0 20px #605ddba0 !important;
            transition: box-shadow 0.5s, border 0.5s, background 0.5s;
            animation: blogPulse 1.2s 2;
        }
    </style>

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container mt-5 pt-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Contenedor de búsqueda -->
            <div class="search-container">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar blogs..." id="searchInput">
                </div>
                <!-- Botones de categoría -->
                <div class="btn-group" role="group" aria-label="Categorías">
                    <button type="button" class="btn btn-outline-primary" data-category="all">Todas</button>
                    <button type="button" class="btn btn-outline-primary" data-category="experiencia">Experiencia</button>
                    <button type="button" class="btn btn-outline-primary" data-category="historia">Historia</button>
                    <button type="button" class="btn btn-outline-primary" data-category="tecnologia">Tecnología</button>
                    <button type="button" class="btn btn-outline-primary" data-category="viajes">Viajes</button>
                    <button type="button" class="btn btn-outline-primary" data-category="cultura">Cultura</button>
                </div>
            </div>
            <!-- Contenedor de blogs -->
            <div class="row blog-container" id="blogContainer">
                @foreach($blogs as $blog)
                    @php
                        // Contar likes para cada blog
                        $likesCount = $blog->likes->count();
                    @endphp
                    <div class="col-md-4" id="blog-card-{{ $blog->id }}">
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
                                    <!-- El botón tendrá la clase 'liked' si el usuario ya dio like a este blog -->
                                    @php
                                        $userLiked = $blog->likes->where('user_id', Auth::id())->count() > 0;
                                    @endphp
                                    <button class="btn btn-link like-button{{ $userLiked ? ' liked' : '' }}" data-blog-id="{{ $blog->id }}">
                                        <i class="fas fa-thumbs-up"></i><span class="like-count" id="like-count-{{ $blog->id }}">{{ $likesCount }}</span>
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
                                        @if(Auth::id() == $blog->user_id)
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
                                        @else
                                            <p>No tienes permiso para editar este blog.</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Botón de Eliminar -->
                                        @if(Auth::id() == $blog->user_id)
                                            <form id="deleteForm{{ $blog->id }}" action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $blog->id }})">Eliminar</button>
                                            </form>
                                        @endif
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
                                        <div class="comments-list">
                                        @foreach($blog->comments as $comment)
                                            <div class="comment">
                                                <p>{{ $comment->content }}</p>
                                                <!-- Contenedor para los botones de acción -->
                                                <div class="comment-actions">
                                                <!-- Verifica si el usuario autenticado es el dueño del comentario -->
                                                @if(Auth::id() === $comment->user_id)  
                                                    <div class="d-flex justify-content-end">
                                                        <button onclick="editComment({{ $comment->id }}, '{{ $comment->content }}')" class="btn btn-sm btn-primary edit-comment">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </button>
                                                        <button onclick="deleteComment({{ $comment->id }})" class="btn btn-sm btn-danger delete-comment">
                                                            <i class="fas fa-trash-alt"></i> Eliminar
                                                        </button>
                                                    </div>
                                                @endif
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para confirmar la eliminación de un blog
        function confirmDelete(blogId) {
            if (confirm("¿Estás seguro de que deseas eliminar este blog?")) {
                document.getElementById('deleteForm' + blogId).submit();
            }
        }

        // Función para editar un comentario
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

        // Función para eliminar un comentario
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

        // Eventos al cargar el DOM
        document.addEventListener('DOMContentLoaded', function() {
            // Función para filtrar blogs por categoría
            document.querySelectorAll('.btn-group .btn').forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    document.querySelectorAll('.blog-container .col-md-4').forEach(blog => {
                        const blogCategory = blog.querySelector('.badge').textContent.toLowerCase();
                        if (category === 'all' || blogCategory === category) {
                            blog.style.display = 'block';
                        } else {
                            blog.style.display = 'none';
                        }
                    });
                });
            });

            // Función para buscar blogs en tiempo real
            document.getElementById('searchInput').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('.blog-container .col-md-4').forEach(blog => {
                    const title = blog.querySelector('.card-title').textContent.toLowerCase();
                    const content = blog.querySelector('.card-text').textContent.toLowerCase();
                    if (title.includes(searchTerm) || content.includes(searchTerm)) {
                        blog.style.display = 'block';
                    } else {
                        blog.style.display = 'none';
                    }
                });
            });

            // Función para manejar los "me gusta" y "unlike"
            document.querySelectorAll('.like-button').forEach(button => {
                button.addEventListener('click', function() {
                    const blogId = this.getAttribute('data-blog-id');
                    const likeButton = this;
                    const likeCountSpan = document.getElementById('like-count-' + blogId);
                    let currentLikes = parseInt(likeCountSpan.textContent);
                    // Si el botón ya tiene la clase 'liked', significa que el usuario ya dio like y quiere quitarlo (unlike)
                    const isLiked = likeButton.classList.contains('liked');
                    if (isLiked) {
                        // Quitar el like (unlike): enviar petición DELETE al backend
                        fetch(`/api/likes/${blogId}/user/{{ Auth::id() }}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Si se eliminó correctamente, actualiza el contador y el color
                            likeButton.classList.remove('liked');
                            likeCountSpan.textContent = Math.max(currentLikes - 1, 0);
                        })
                        .catch(error => {
                            alert('Error al quitar el me gusta.');
                        });
                    } else {
                        // Dar like: enviar petición POST al backend
                        fetch('/api/likes', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                blog_id: blogId,
                                user_id: {{ Auth::id() }}
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.id) {
                                // Like guardado correctamente, incrementa el contador y marca el botón
                                likeButton.classList.add('liked');
                                likeCountSpan.textContent = currentLikes + 1;
                            } else if(data.errors && data.errors.blog_id) {
                                alert('Ya diste me gusta a este blog.');
                            }
                        })
                        .catch(error => {
                            alert('Error al dar me gusta.');
                        });
                    }
                });
            });

            // Resaltar y hacer scroll al blog si hay highlight
            const urlParams = new URLSearchParams(window.location.search);
            const highlightId = urlParams.get('highlight');
            if (highlightId) {
                const blogCard = document.getElementById('blog-card-' + highlightId);
                if (blogCard) {
                    blogCard.classList.add('highlight-blog');
                    blogCard.style.animation = 'blogPulse 1.2s 2'; // animación personalizada
                    blogCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => {
                        blogCard.classList.remove('highlight-blog');
                        blogCard.style.animation = '';
                    }, 3500);
                }
            }
        });
    </script>
    <style>
    @keyframes blogPulse {
        0% { box-shadow: 0 0 0 0 #41cdf480; }
        50% { box-shadow: 0 0 30px 10px #605ddbcc; }
        100% { box-shadow: 0 0 0 0 #41cdf480; }
    }
    .highlight-blog {
        border: 3px solid #41cdf4 !important;
        background: #87d4f5 !important;
        box-shadow: 0 0 20px #605ddba0 !important;
        transition: box-shadow 0.5s, border 0.5s, background 0.5s;
        animation: blogPulse 1.2s 2;
    }
    </style>
    @endsection
