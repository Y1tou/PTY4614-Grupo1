<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    // use HasFactory;
    protected $table = 'voto'; 
    protected $primaryKey = 'ID'; 
    protected $keyType = 'string';
    protected $fillable = ['ID', 'SIGLA', 'RUN', 'OPCION_VOTADA', 'CARRERA', 'CORREO'
    ];
}
