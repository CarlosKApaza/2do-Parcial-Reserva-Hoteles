<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitacionController;

// ruta rest para hotel gran sucre
Route::get('/habitacion/{codHabitacion}', [HabitacionController::class, 'show']);
Route::put('/habitacion/{codHabitacion}', [HabitacionController::class, 'update']);