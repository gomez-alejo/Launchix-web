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
</style>
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
                                <span class="badge badge-primary">{{ $blog->category->name }}</span>
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
                                    <div class="comments-list">
                                     
                                    </div>
                                    <div class="comment-section">
                                        <textarea class="form-control" rows="2" placeholder="Añadir un comentario..."></textarea>
                                        <button class="btn btn-sm btn-primary mt-2">Comentar</button>
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

<script>
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

    // Función para manejar el envío de comentarios
    $('.comment-section button').on('click', function() {
        const comment = $(this).siblings('textarea').val();
        if (comment.trim() !== '') {
            alert('Comentario enviado: ' + comment);
            $(this).siblings('textarea').val('');
        }
    });
</script>
@endsection
