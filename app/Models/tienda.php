<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tienda extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        "nombre",
        "precio",
        "cantidad",
        "descripcion"
    ];
    use HasFactory;


}
