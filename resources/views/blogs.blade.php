@extends('layout.app')

@section('title', 'Página Principal')

@section('content')
<style>
    .blog-container {
        margin-top: 30px;
    }
    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        height: 350px;
        overflow: hidden;
    }
    .search-container {
        margin-bottom: 20px;
    }
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
        color: #ffc107;
    }
    .rating > label:hover,
    .rating > label:hover ~ label {
        color: #ffc107;
    }
    .comment-section {
        margin-top: 20px;
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .comments-list {
        margin-top: 20px;
    }
    .comment {
        border-bottom: 1px solid #eee;
        padding: 10px 0;
    }
    .card-title {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .modal-title {
        word-wrap: break-word;
        white-space: normal;
    }
    .modal-body p {
        word-wrap: break-word;
        white-space: normal;
    }
    .like-button i, .btn-link i {
        margin-right: 5px;
    }
    .like-button {
        color: #ccc;
        cursor: pointer;
    }
    .like-button.liked {
        color: #ff0000;
    }
    .edit-comment, .delete-comment {
        margin-left: 10px;
    }
    .edit-comment i, .delete-comment i {
        margin-right: 5px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container mt-5 pt-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="search-container">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar blogs..." id="searchInput">
                </div>
                <div class="btn-group" role="group" aria-label="Categorías">
                    <button type="button" class="btn btn-outline-primary" data-category="all">Todas</button>
                    <button type="button" class="btn btn-outline-primary" data-category="experiencia">Experiencia</button>
                    <button type="button" class="btn btn-outline-primary" data-category="historia">Historia</button>
                    <button type="button" class="btn btn-outline-primary" data-category="tecnologia">Tecnología</button>
                    <button type="button" class="btn btn-outline-primary" data-category="viajes">Viajes</button>
                    <button type="button" class="btn btn-outline-primary" data-category="cultura">Cultura</button>
                </div>
            </div>
            <div class="row blog-container" id="blogContainer">
                @foreach($blogs as $blog)
                    <div class="col-md-4">
                        <div class="card">
                            @if($blog->image_path)
                                <img src="{{ asset($blog->image_path) }}" class="card-img-top" alt="{{ $blog->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                                <span class="badge badge-primary">{{ strtolower($blog->category->name) }}</span>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <button class="btn btn-link" data-toggle="modal" data-target="#commentsModal{{ $blog->id }}">
                                        <i class="fas fa-comment"></i> Comentarios
                                    </button>
                                    <button class="btn btn-link like-button" data-blog-id="{{ $blog->id }}">
                                        <i class="fas fa-heart"></i> Me gusta
                                    </button>
                                </div>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#blogModal{{ $blog->id }}">Leer más</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Blog -->
                    <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel{{ $blog->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="blogModalLabel{{ $blog->id }}">{{ $blog->title }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $blog->content }}</p>
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
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

    $(document).ready(function() {
        // Función para filtrar blogs por categoría
        $('.btn-group .btn').on('click', function() {
            const category = $(this).data('category');
            $('.blog-container .col-md-4').each(function() {
                const blogCategory = $(this).find('.badge').text().toLowerCase();
                if (category === 'all' || blogCategory === category) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Función para buscar blogs en tiempo real
        $('#searchInput').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.blog-container .col-md-4').each(function() {
                const title = $(this).find('.card-title').text().toLowerCase();
                const content = $(this).find('.card-text').text().toLowerCase();
                if (title.includes(searchTerm) || content.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Función para manejar los "me gusta"
        $('.like-button').on('click', function() {
            const blogId = $(this).data('blog-id');
            $(this).toggleClass('liked');
            alert('Me gusta en el blog: ' + blogId);
        });
    });
</script>
@endsection
