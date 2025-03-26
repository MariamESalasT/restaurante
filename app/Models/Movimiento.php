<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    protected $fillable = [
        'tipo',
        'cantidad',
        'fecha',
        'id_usuarios',
        'id_productos'
    ];

    /**
     * Relación con el modelo Usuario (un movimiento pertenece a un usuario).
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuarios');
    }

    /**
     * Relación con el modelo Producto (un movimiento pertenece a un producto).
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_productos');
    }
}
