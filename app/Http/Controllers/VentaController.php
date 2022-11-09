<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
  public function obtener(){
    $ventas = Venta::join('usuarios','ventas.id_usuario','=','usuarios.id')
    ->join('productos','ventas.id_producto','=','productos.id')
    ->select(
        'ventas.*',
        'usuarios.nombre',
        'productos.Producto'
    )->get();
    return response($ventas,200);
  }

  public function crear(Request $request)
  {
      $datos = $request->validate($this->validationRequest());
      $VentaCliente = Venta::create($datos);
      return response([
          'message' => 'Se registro con exito la venta',
          'id' => $VentaCliente['id']
      ],201);
      //return 'Se creo un usuario';
  }


  private function validationRequest(){
    return [
        "id_usuario" => "required|numeric",
        "id_producto" => "required|numeric"
    ];
}

public function eliminar($id)
{
    $usuario = Venta::find($id);
    if(!$usuario){
    return response([
        'message' => 'Se elminio la venta: '. $id
    ]);
    }

}
}
