<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('news', [\App\Http\Controllers\Controller::class, 'index'])->name('news');
Route::post('news', [\App\Http\Controllers\Controller::class, 'store']);
Route::put('news/{id}', [\App\Http\Controllers\Controller::class, 'update']);
Route::delete('news/{id}', [\App\Http\Controllers\Controller::class, 'destroy']);
Route::post('/register', [PostController::class, 'register']);
Route::post('/sgnin', [PostController::class, 'sgnin']);

