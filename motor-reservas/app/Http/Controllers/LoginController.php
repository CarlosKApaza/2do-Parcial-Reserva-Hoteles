<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->email == 'agencia@turismo.com' && $request->password == '123456') {
            $key = env('JWT_SECRET');
            $algoritmo = env('JWT_ALGORITHM');
            $time = time();
            
            $payload = array(
                'iat' => $time,
                'exp' => $time + (1200 * 60),
                'agencia' => 'Agencia Online'
            );
            
            $jwt = JWT::encode($payload, $key, $algoritmo);
            
            return response()->json([
                'mensaje' => 'Autenticación Exitosa',
                'token' => $jwt
            ], 200);
        }
        return response()->json(['mensaje' => 'Credenciales inválidas'], 401);
    }
}