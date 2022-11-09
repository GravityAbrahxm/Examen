<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;

class Login extends Controller
{

    public function Login( Request $request)
    {
        $data = $request->validate([
            'email' =>  'required|email|string',
            'password' => 'required|min:4'
        ]);

        $usuario = Usuario::where('email',$data['email'])
        ->where('password',$data['password'])->first();

        if($usuario==null){
            return response([
                'message' => 'Email no registrado'
            ],404);
        }

        $token = $usuario->createToken('user-token')->plainTextToken;

        return response([
            'usuario'=>$usuario,
            'token'=>$token
        ]);

    }

}



