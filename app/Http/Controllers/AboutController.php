<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        return view('about.index', [
            "title" => "About",
            "name" => "Asyifa Maulana",
            "email" => "asyifamaualana1412@gmail.com",
            "image" => "profile-1.png",
            "active" => 'about',
        ]);
    }
}
