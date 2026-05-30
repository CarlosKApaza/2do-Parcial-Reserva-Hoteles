<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB; 

class ReservaController extends Controller
{
    public function reservar(Request $request)
    {
        $hotelDestino = $request->hotelDestino;
        $codHabitacion = $request->codHabitacion;

        // hotel gran sucre
        if ($hotelDestino == 'Gran Sucre') {
            $consulta = Http::get("http://127.0.0.1:8001/api/habitacion/".$codHabitacion);
            if ($consulta->failed()) return response()->json(['error' => 'No existe en Gran Sucre'], 404);
            $habitacion = $consulta->json();

            if ($habitacion['disponible'] == 1 || $habitacion['disponible'] == true) {
                $reserva = Http::put("http://127.0.0.1:8001/api/habitacion/".$codHabitacion);
                
                // guardamos el registro
                DB::table('reservas')->insert([
                    'fecha' => $request->fecha,
                    'idHuesped' => $request->idHuesped,
                    'hotelDestino' => $hotelDestino,
                    'codHabitacion' => $codHabitacion,
                    'noches' => $request->noches,
                    'estado' => 'Confirmada REST'
                ]);

                return response()->json([
                    'mensaje' => 'Reserva exitosa en Hotel Gran Sucre (REST)',
                    'detalle' => $reserva->json()
                ], 200);
            } else {
                return response()->json(['error' => 'Habitación ocupada en Gran Sucre'], 400);
            }
        }

        // hotel mirador andino
        if ($hotelDestino == 'Mirador Andino') {
            $query = 'query { habitacion(codHabitacion: "'.$codHabitacion.'") { disponible } }';
            $consulta = Http::post("http://127.0.0.1:4000/graphql", ['query' => $query]);
            $respuesta = $consulta->json();

            if (!isset($respuesta['data']['habitacion']) || $respuesta['data']['habitacion'] == null) {
                return response()->json(['error' => 'Habitación no existe en Mirador Andino'], 404);
            }

            $habitacion = $respuesta['data']['habitacion'];

            if ($habitacion['disponible'] == true) {
                $mutation = 'mutation { actualizarDisponibilidad(codHabitacion: "'.$codHabitacion.'") { codHabitacion disponible } }';
                $reserva = Http::post("http://127.0.0.1:4000/graphql", ['query' => $mutation]);

                // guardamos las reservas
                DB::table('reservas')->insert([
                    'fecha' => $request->fecha,
                    'idHuesped' => $request->idHuesped,
                    'hotelDestino' => $hotelDestino,
                    'codHabitacion' => $codHabitacion,
                    'noches' => $request->noches,
                    'estado' => 'Confirmada GraphQL'
                ]);

                return response()->json([
                    'mensaje' => 'Reserva exitosa en Hotel Mirador Andino (GraphQL)',
                    'detalle' => $reserva->json()['data']['actualizarDisponibilidad']
                ], 200);
            } else {
                return response()->json(['error' => 'La habitación ya está ocupada en Mirador Andino'], 400);
            }
        }

        return response()->json(['error' => 'Hotel destino no soportado'], 400);
    }
}