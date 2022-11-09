<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function crear(Request $request)
    {
        $datos = $request->validate($this->validationRequest());
        $usuario = Usuario::create($datos);
        return response([
            'message' => 'Se registro con exito el usuario',
            'id' => $usuario['id']
        ],201);
        //return 'Se creo un usuario';
    }

    public function obtener()
    {
        //TODOS LOS USUARIOS
        $usuarios = Usuario::all();

        //TODOS LOS USUARIOS EN PAGINADOS
        //$usuarios = Usuario::paginate(2);

        //CONTAR USUARIOS
        //$usuarios = Usuario::count();

        //TOMAR UNA CANTIDAD DE USUARIIOS
        //$usuarios = Usuario::all()->take(2);

        return $usuarios;
    }

    public function modificar($id, Request $request)
    {
        $usuario = Usuario::find($id);
        if(!$usuario){
            return response([
                'message' => 'No existe el usuario con la id: '. $id
            ],404);
        }
        $datos = $request-> validate($this->validationRequest());
        $usuario->update($datos);
        return response([
            'message' => 'Se modifico con exito'
        ]);

    }

    public function eliminar($id)
    {
        $usuario = Usuario::find($id);
        if(!$usuario){
        return response([
            'message' => 'return Se elminio el usuario: '. $id
        ]);
        }

    }

    public function CambioPass($id, Request $request)
    {
        $usuarios = Usuario::find($id);
        if(!$usuarios){
            return response([
                'message'=>'ERROR, NO SE ENCONTRO EL USUARIO' . $id
            ], 404);
        }else if(!$usuarios["codigo_verificacion"]){
            return response(['message'=>'ERROR, no se puede cambiar'], 200);
        }else if ($request["codigo_verificacion"]== $usuarios["codigo_verificacion"]){
            $usuarios -> update(["password" => $request["password"], "codigo_verificacion"=>'']);
            return response([
                'message'=>'Contraseña actualizada'
            ]);
        }

        return response([
            'message'=>'codigo invalido'
        ]);
    }

    public function Verificacion($id, Request $request){
        $usuarios = Usuario::find($id);
        //validar si existe usuario
        if(!$usuarios){
            return response([
                'message'=> 'ERROR, NO SE ENCONTRO EL USUARIO' . $id
            ], 404);
        }

        $code = Str::random(10);
        $usuarios -> update(["codigo_verificacion" => $code]);
        return response([
            'message'=> 'el codigo es ' . $code
        ]);

    }

    private function validationRequest(){
        return [
            'nombre' => 'required|string',
            'email'=> 'required|string|email',
            'password'=> 'required|min:4',
            'peso'=> 'required|numeric',
        ];
    }
}
