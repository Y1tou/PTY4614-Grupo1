<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    protected $table = 'votacion';
    protected $primaryKey = 'SIGLA'; 
    protected $keyType = 'string';
    protected $fillable = ['SIGLA', 'NOMBRE', 'DESCRIPCION', 'OPC_1', 'OPC_2', 'OPC_3', 'OPC_4', 'ESTADO'
    ];
}
