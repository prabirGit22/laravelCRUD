<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = Post::all();
    return view('welcome', compact('posts'));
})->name('home');

Route::get('/create', [PostController::class , 'create']);
Route::post('/store', [PostController::class , 'ourfilestore'])->name('store');
Route::get('/edit/{id}', [PostController::class , 'editData'])->name('edit');
Route::post('/update/{id}', [PostController::class , 'updateData'])->name('update');
Route::get('/delete/{id}', [PostController::class , 'deleteData'])->name('delete');
