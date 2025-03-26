<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Especificamos el nombre de la tabla
    protected $table = 'usuarios';

    // Campos que pueden ser asignados en masa
    protected $fillable = [
        'nombre',
        'ap_paterno',
        'ap_materno',
        'rol',
        'email',
        'password',
    ];

    // Ocultamos la contraseña al serializar el modelo
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relación con Movimientos (un usuario puede realizar múltiples movimientos)
    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'id_usuario');
    }

    // Mutador para encriptar la contraseña automáticamente
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
