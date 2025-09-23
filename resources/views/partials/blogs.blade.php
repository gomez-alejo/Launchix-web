<style>
    .blog-container {
        margin-top: 30px;
    }
    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        height: 350px; /* Altura fija para las tarjetas */
        overflow: hidden; /* Oculta el contenido que se desborde */
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
        -webkit-line-clamp: 2; /* Limita el título a 2 líneas */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Limita el contenido a 3 líneas */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .modal-title {
        word-wrap: break-word; /* Permite que el texto del título salte de línea si es demasiado largo */
        white-space: normal; /* Permite que el texto se ajuste automáticamente */
    }
    .modal-body p {
        word-wrap: break-word; /* Permite que el texto del contenido salte de línea si es demasiado largo */
        white-space: normal; /* Permite que el texto se ajuste automáticamente */
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
   <div class="row blog-container" id="blogContainer">
                <!-- Los blogs se cargarán aquí -->
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
                                        <!-- Aquí se cargarán los comentarios -->
                                        @foreach($blog->comments as $comment)
                                            <div class="comment">
                                                <p>{{ $comment->content }}</p>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-sm btn-primary edit-comment" data-comment-id="{{ $comment->id }}" data-comment-content="{{ $comment->content }}">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </button>
                                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger delete-comment">
                                                            <i class="fas fa-trash-alt"></i> Eliminar
                                                        </button>
                                                    </form>
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