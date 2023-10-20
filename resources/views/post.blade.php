@extends('layouts.main')

@section('container')


    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h2 class="mb-3">{{ $post->title }}</h2>
        
                <p>By. <a class="text-decoration-none" href="/?author={{ $post->author->username }}">{{ $post->author->name }}</a> in <a class="text-decoration-none" href="/?category={{ $post->category->slug }}">{{ $post->category->name }}</a> <i class="bi bi-eye"></i> {{ $post->count }} visitors</p>

                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>
                
                <a class="text-decoration-none d-block mt-3" href="/">Back to Posts</a>
            </div>
        </div>
    </div>
        
@endsection