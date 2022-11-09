<?php

namespace App\Http\Controllers;

use App\Models\tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function obtenerProducto()
    {
        //TODOS LOS USUARIOS
        $producto = tienda::all();



        return $producto;
    }

    public function CrearProducto(Request $request){
        $datos = $request-> validate($this->validationRequest());
        $Productos = tienda::create($datos);
        return response([
            'message' => 'El producto se ha registrado',
            'id' => $Productos['id']
        ],201);
    }

    public function ModificarProducto($id, Request $request)
    {
        $producto = tienda::find($id);
        if(!$producto){
            return response([
                'message' => 'No existe el producto con la id: '. $id
            ],404);
        }
        $datos = $request-> validate($this->validationRequest());
        $producto->update($datos);
        return response([
            'message' => 'Se modifico con exito el producto'
        ]);

    }

    public function EliminarProducto($id){
        $producto = tienda::find($id);
        if(!$producto){
        return response([
            'message' => 'Se elminio el usuario: '. $id
        ]);
        }
    }

    private function validationRequest(){
        return [
            'nombre' => 'required|string',
            'precio'=> 'required|numeric',
            'cantidad'=> 'required|numeric',
            'descripcion'=> 'required|string',
        ];
    }
}
