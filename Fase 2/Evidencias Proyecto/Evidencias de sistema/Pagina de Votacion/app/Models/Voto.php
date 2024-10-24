<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    // Si no necesitas usar HasFactory, está bien dejarlo fuera
    // protected $keyType = 'string'; // Solo si el campo 'ID' es un string, si es entero puedes eliminar esto.
    
    protected $table = 'voto';        // Nombre de la tabla
    protected $primaryKey = 'ID';     // Clave primaria de la tabla

    protected $fillable = [
        'ID', 'SIGLA', 'RUN', 'OPCION_VOTADA', 'CARRERA', 'CORREO'  // Campos asignables
    ];
}
