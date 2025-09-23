@extends('layout.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container mt-5 pt-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">{{ $blog->title }}</h3>
                    <span class="badge badge-primary">{{ strtolower($blog->category->name ?? 'Sin categoría') }}</span>
                </div>
                <div class="card-img-container">
                    @if($blog->image_path)
                        <img src="{{ asset($blog->image_path) }}" class="card-img-top" alt="{{ $blog->title }}">
                    @endif
                </div>
                <div class="card-body">
                    <div class="blog-meta mb-2">
                        <span class="author">Por {{ $blog->user->name ?? 'Autor desconocido' }}</span>
                        <span class="date ms-3">{{ $blog->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="blog-content mb-3">
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                    <div class="blog-tags mb-2">
                        @foreach($blog->tags as $tag)
                            <span class="badge bg-info text-dark">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="blog-likes-comments d-flex justify-content-between align-items-center mt-3">
                        <span class="likes"><i class="fas fa-heart text-danger"></i> {{ $blog->likes_count ?? 0 }} Me gusta</span>
                        <span class="comments"><i class="fas fa-comment text-primary"></i> {{ $blog->comments_count ?? 0 }} Comentarios</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="/css/blog-detail.css">
<style>
.card-img-container {
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    background: #f8f9fa;
}
.card-img-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
</style>
@endpush
