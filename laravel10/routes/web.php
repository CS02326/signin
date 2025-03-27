<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Controller;
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

//Route::get('/', function () {
//    return view('welcome');
//});
// 注册路由
Route::resource('news', Controller::class);
Route::get('/', [PostController::class, 'login'])->name('login');;
Route::post('/sgnin', [PostController::class, 'sgnin'])->name('home');
Route::get('/register', [PostController::class, 'registerviwe']);
Route::post('/register', [PostController::class, 'register']);
Route::get('/storeviem', [PostController::class, 'storeviem'])->name('store');
Route::post('/store', [PostController::class, 'store']);
Route::get('/news', [PostController::class, 'news'])->name('news');
Route::delete('/news/{id}', [Controller::class, 'destroy'])->name('news.destroy');



