<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClubController;
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

Route::prefix('v1')->as('v1:')->group(static function (): void {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::group(['prefix' => 'clubs', 'as' => 'clubs.'], function () {
        Route::get('/clubs', [AuthController::class, 'index'])->name('index');
        Route::post('/clubs', [AuthController::class, 'store'])->name('store');
        //Route::get('/clubs/{id}', [AuthController::class, 'show'])->name('show');
        Route::put('/clubs/{id}', [AuthController::class, 'update'])->name('update');
        Route::delete('/clubs/{id}', [AuthController::class, 'destroy'])->name('destroy');
    });
});
