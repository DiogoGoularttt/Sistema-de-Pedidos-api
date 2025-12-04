<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ----------------------
// Rotas públicas
// ----------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// ----------------------
// Rotas autenticadas
// ----------------------
Route::middleware('auth:sanctum')->group(function () {

    // Info do usuário logado
    Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
        return response()->json($request->user());
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});


// ----------------------
// ADMIN
// ----------------------
Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return response()->json(['message' => 'Bem-vindo ao Dashboard Admin']);
        });
    });


// ----------------------
// CLIENT
// ----------------------
Route::middleware(['auth:sanctum', 'role:client'])
    ->group(function () {
        Route::get('/menu', function () {
            return response()->json(['message' => 'Aqui está o cardápio']);
        });

        Route::get('/orders', function () {
            return response()->json(['message' => 'Aqui estão seus pedidos']);
        });
    });
