<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $table = 'VOTO';        // Nombre de la tabla (asegúrate de que coincide con el nombre real en la base de datos)
    protected $primaryKey = 'ID';     // Clave primaria de la tabla
    public $timestamps = false;       // Desactiva las marcas de tiempo

    protected $fillable = [
        'SIGLA', 'RUN', 'OPCION_VOTADA', 'CARRERA', 'CORREO'  // Campos asignables
    ];
}
