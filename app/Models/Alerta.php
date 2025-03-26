<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo (si el nombre de la tabla no sigue la convención)
    protected $table = 'alertas';

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'tipo',
        'fecha_generacion',
        'estado',
        'id_productos', // Descomentar si hay relación con productos
    ];

    // Relación con los productos (si cada alerta está relacionada con un producto)
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_productos');
    }
}
