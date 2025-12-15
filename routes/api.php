<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']); // sem middleware
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', function (Request $request) {
            return $request->user();
        });
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Verificação de E-mail
|--------------------------------------------------------------------------
*/

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth:sanctum'])
    ->name('verification.resend');


/*
|--------------------------------------------------------------------------
| Rotas Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return response()->json([
                'message' => 'Bem-vindo ao Dashboard Admin'
            ]);
        });
    });


/*
|--------------------------------------------------------------------------
| Rotas Client
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:client'])
    ->group(function () {

        Route::get('/menu', function () {
            return response()->json([
                'message' => 'Aqui está o cardápio'
            ]);
        });

        Route::get('/orders', function () {
            return response()->json([
                'message' => 'Aqui estão seus pedidos'
            ]);
        });
    });
