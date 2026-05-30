<?php
namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    // Función para consultar disponibilidad de la habitación
    public function show($codHabitacion)
    {
        $habitacion = Habitacion::find($codHabitacion);
        
        if(!$habitacion) {
            return response()->json(['mensaje' => 'Habitación no encontrada'], 404);
        }
        
        return response()->json($habitacion, 200);
    }

    // Función para confirmar la reserva y cambiar a no disponible
    public function update(Request $request, $codHabitacion)
    {
        $habitacion = Habitacion::find($codHabitacion);
        
        if(!$habitacion) {
            return response()->json(['mensaje' => 'Habitación no encontrada'], 404);
        }

        if($habitacion->disponible == 0 || $habitacion->disponible == false) {
            return response()->json(['mensaje' => 'La habitación ya está ocupada'], 400);
        }
        
        // Cambiamos el estado a No Disponible (0)
        $habitacion->disponible = 0;
        $habitacion->save();

        return response()->json([
            'mensaje' => 'Reserva confirmada exitosamente en Hotel Gran Sucre',
            'habitacion' => $habitacion
        ], 200);
    }
}