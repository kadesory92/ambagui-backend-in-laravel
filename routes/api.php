<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'user-access:ADM'])->group(function () {
  
    Route::post('/add-category', [CategoryController::class, 'store']);
    Route::get('/categories', [CategoryController::class, 'index']);

    Route::post('/add-post', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'index']);
});

Route::middleware(['auth', 'user-access:USR'])->group(function () {

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
