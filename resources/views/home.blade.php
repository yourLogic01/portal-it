@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center"> <img src="image/portal-1.png" alt="portal" width="28"> {{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                    <button class="btn btn-dark btn-search" type="submit">Search</button>
                  </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center text-center mb-3">
        <div class="col-md-6">
            <h5>Portal untuk sharing dan berdiskusi seputar dunia IT dengan para peminat teknologi melalui forun online</h5>
        </div>
    </div>

    <div class="row justify-content-end mb-3">
        <div class="col-md-3 mb-3">
            <a class="btn btn-post" data-bs-toggle="collapse" href="#collapsePostForm" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="bi bi-plus"></i> Buat Post baru
              </a>
        </div>
        <div class="collapse" id="collapsePostForm">
            <div class="card card-body">
                    <form method="post" action="/" class="mb-5" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name=title required autofocus value="{{ old('title') }}"> 
                          @error('title')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="slug" class="form-label">Slug</label>
                          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name=slug required value="{{ old('slug') }}">
                          @error('slug')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="category" class="form-label">Category</label>
                          <select class="form-select" name="category_id">
                            @foreach ($categories as $category)
                            @if (old('category_id')== $category->id)
                              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="body" class="form-label">Body</label>
                          @error('body')
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                          <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                          <trix-editor input="body"></trix-editor>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </form>
            </div>
          </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-12 mb-3 alert-dismissible " role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($posts->count())
        <div class="card mb-3">
            
            <div class="card-body text-center">
            <h3 class="card-title"><a class="text-decoration-none text-dark" href="/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a></h3>
            <p>
                <small class="text-body-secondary">
                    By. <a class="text-decoration-none" href="/?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a> in <a class="text-decoration-none" href="/?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }} <i class="bi bi-eye"></i> {{ $posts[0]->count }} views
                </small>
            </p>
            <p class="card-text">{{ $posts[0]->excerpt }}</p>

            <a class="text-decoration-none btn btn-primary" href="/{{ $posts[0]->slug }}">Read more</a>
            </div>
        </div>
    

    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class=" mt-4 px-3 py-2 " style="background-color: rgba(0,0,0,0.7);max-width :60%"><a href="/?category={{ $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</a></div>
                        <div class="card-body">
                        <h5 class="card-title"><a class="text-decoration-none text-dark" href="/{{ $post->slug }}">{{ $post->title }}</a></h5>
                        <p>
                            <small class="text-body-secondary">
                                By. <a class="text-decoration-none" href="/?author={{ $post->author->username }}">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }} <i class="bi bi-eye"></i> {{ $post->count }} views
                            </small>
                        </p>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="/{{ $post->slug }}" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @else
        <p class="text-center fs-4">No Post found.</p>
    @endif

    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
    

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
      
        title.addEventListener('change', function() {
          fetch('/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        })
      
        document.addEventListener('trix-file-accept', function(e) {
          e.preventDefault();
        })
      
      </script>
@endsection

  