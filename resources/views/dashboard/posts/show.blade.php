@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h2 class="mb-3">{{ $post->title }}</h2>
    
            <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to All My Post</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline" onclick="return confirm('Apakah anda yakin untuk menghapus postingan ini?')">
                @method('delete')
                @csrf
                <button class="btn btn-danger">
                  <span data-feather="x-circle"></span> Delete
                </button>
            </form>
            
            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>
            <div class="card">
                <div class="card-body">
                    <h3>Comments</h3>
                    <hr>
                    @foreach ($comments as $comment)
                        @if($comment)

                        <div class="card mb-2">
                            <div class="card-body">
                            <h6 class="card-title">{{ $comment->author->name }}</h6>
                            <p class="card-text">{{ $comment->body }}</p>
                            </div>
                        </div>
                            
                        @else
                            <p class="text-center fs-4">This post doesnt have comment.</p>
                        @endif
                        
                    @endforeach
                      
                </div>
              </div>
            
            
        </div>
    </div>
</div>

@endsection