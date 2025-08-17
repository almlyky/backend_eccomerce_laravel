<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\http\Middleware\UserIsActive;
use App\Http\Middleware\JwtMiddleware;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});

Route::post('/categories', [CategorieController::class, 'store']);

Route::get('/categories', [CategorieController::class, 'index']);
Route::middleware([JwtMiddleware::class])->group(function () {
Route::get('/products', [ProductController::class, 'index']);
// Route to store a new product
Route::post('/products', [ProductController::class, 'store']);
// Route to display a specific product
Route::get('/products/{pr_id}', [ProductController::class, 'show']);
// Route to update an existing product
Route::put('/products/{pr_id}', [ProductController::class, 'update']);
// Route to delete a product
Route::delete('/products/{pr_id}', [ProductController::class, 'destroy']);


// Routes cart 

});
Route::post('/cart', [CartController::class, 'store']);
Route::get('/cart', [CartController::class, 'index']);
Route::delete('/cart/{id}', [CartController::class, 'destroy']);
Route::put('/cart/{id}', [CartController::class, 'update']);


Route::post('/favorite',[FavoriteController::class,'store']);
Route::get('/favorite',[FavoriteController::class,'index']);
Route::delete('/favorite/{id}',[FavoriteController::class,'destroy']);
Route::put('/favorite/{id}',[FavoriteController::class,'update']);
