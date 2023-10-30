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

                <div class="card">
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success col-lg-12 mb-3 alert-dismissible " role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="post" action="/detail/{{ $post->slug }}/comment" class="mb-5" >
                            @csrf
                            <div class="mb-3">
                              <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                              <label for="body" class="form-label">Comment</label>
                              <textarea class="form-control @error('body') is-invalid @enderror" id="body" name=body rows="3" required></textarea>
                              @error('body')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                              @enderror
                              
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
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
                
                <a class="text-decoration-none d-block mt-3" href="/">Back to Posts</a>
            </div>
        </div>
    </div>
        
@endsection