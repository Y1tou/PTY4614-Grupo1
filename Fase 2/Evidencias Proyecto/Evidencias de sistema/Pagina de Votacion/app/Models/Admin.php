<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table = 'admin';
    protected $fillable = ['NOMBRE', 'CORREO', 'CONTRASENIA', 'TIPO'];
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $keyType = 'int';
    protected $hidden = [
        'CONTRASENIA', // Oculta la contraseña en las consultas
    ];

    // Método para encriptar la contraseña al guardar
    public function setPasswordAttribute($password)
    {
        $this->attributes['CONTRASENIA'] = bcrypt($password);
    }

    // Validación de contraseñas
    public function validatePassword($password)
    {
        return password_verify($password, $this->CONTRASENIA);
    }

    // Método para obtener la contraseña correctamente
    public function getAuthPassword()
    {
        return $this->CONTRASENIA;
    }

    // Constantes para tipos de administradores
    const TIPO_SUPERADMIN = 1;
    const TIPO_ADMIN_AE = 2;

}

