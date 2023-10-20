<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    
    public function index() {
        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' posts in ' . $category->name;
        }
        if(request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' posts by ' . $author->name;
        }
        return view('home', [
            "title" => "Portal-IT" . $title,
            "active" => 'home',
            'categories' => Category::all(),
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(9)->withQueryString(),
            
        ]);
    }
    public function show(Post $post) {
        $postId = Post::find($post->id);
        $postId->increment('count');
        return view('post', [
            "title" => "detail post",
            "active" => 'post',
            "post" => $post
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'=> 'required|max:255',
            'slug'=> 'required|unique:posts',
            'category_id'=> 'required',
            'body'=> 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validatedData);

        return redirect('/')->with('success', 'Your post has been added!');
    }
    public function checkSlug(Request $request) {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
