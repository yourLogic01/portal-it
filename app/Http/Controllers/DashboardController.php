<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        if (auth()->user()->is_admin) {
            $record = Post::select(DB::raw("count"), DB::raw("title as title_name"))
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();
        } else {
            $record = Post::select(DB::raw("count"), DB::raw("title as title_name"))
            ->where('user_id', auth()->user()->id)
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();
        }
        $data = [];
        foreach( $record as $row) {
            $data['label'][] = $row->title_name;
            $data['data'][] = (int) $row->count;
        }
        $data['chart_data'] = json_encode($data);
        $user = User::get()->count();
        $category = Category::get()->count();
        $post = Post::get()->count();
        $total = compact('user','category','post');
        return view('dashboard.index', $data, $total);
    }
}
