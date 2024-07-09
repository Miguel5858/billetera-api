<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Rutas accesibles solo para usuarios autenticados (normal o superusuario)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'getAllUSers']);

    // Ruta para obtener el balance de todos los usuarios por el superusuario
    Route::get('/transactions/all/{superuserId}', [DepositController::class, 'getAllUsersWithBalance']);


    Route::get('/total-general', [DepositController::class, 'getTotalGeneral']);

    
    // Ruta para realizar un depósito por el superusuario
    Route::post('/deposits/{superuserId}', [DepositController::class, 'store']);

    // Ruta para obtener los depósitos de un usuario
    Route::get('/user/deposits/{userId}', [DepositController::class, 'showUserDeposits']);
    Route::get('/user/withdrawals/{userId}', [DepositController::class, 'showUserWithdrawals']);

    // Ruta para realizar un retiro por el superusuario
    Route::post('/withdraw/{superuserId}', [DepositController::class, 'withdraw']);

    Route::post('/logout', [AuthController::class, 'logout']);
    // Ruta para obtener los datos del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Ruta para el registro de nuevos usuarios
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



