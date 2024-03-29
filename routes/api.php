<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware([
    'api',
    'jwt.auth'
])->group(function () {
    Route::get('star-war', [MovieController::class, 'index'])->name('movie.star.war');
    Route::get('movie/{id}', [MovieController::class, 'getMovie'])->name('movie');
    Route::post('movie-store', [MovieController::class, 'store'])->name('movie.store');
    Route::put('movie-update/{id}', [MovieController::class, 'update'])->name('movie.update');
    Route::delete('movie-delete/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');
    Route::get('movie-filter', [MovieController::class, 'filter'])->name('movie.filter');

});



