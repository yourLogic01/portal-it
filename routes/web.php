<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// route home
Route::get('/', [HomeController::class, 'index']);
// about route
Route::get('/about', [AboutController::class, 'index']);



// login route
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
// route redirect log out
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// dashboard logout
Route::post('/dashboard/logout', [LoginController::class, 'logout']);

// route register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// route dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');
// route check slug
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// route crud posts
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// route category for admin
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
// check slug for category
Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('auth');

// check slug home post
Route::get('/checkSlug', [HomeController::class, 'checkSlug']);

// creeate post in home
Route::post('/', [HomeController::class, 'store'])->middleware('auth');

//route add comment
Route::post('/detail/{slug}/comment', [CommentController::class, 'store'])->middleware('auth');

//route post detail
Route::get('/detail/{post:slug}', [HomeController::class, 'show']);

