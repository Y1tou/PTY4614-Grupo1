<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    protected $table = 'votacion'; // Nombre correcto de la tabla en la base de datos

    protected $fillable = [
        'NOMBRE',
        'DESCRIPCION',
        'OPC_1',
        'OPC_2',
        'OPC_3',
        'OPC_4',
        'ESTADO'
    ];
}
