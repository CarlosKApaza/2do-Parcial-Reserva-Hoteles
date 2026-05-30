<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservaController;
use App\Http\Middleware\JwtMiddleware;

Route::post('/login', [LoginController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('/reserva', [ReservaController::class, 'reservar']);
});