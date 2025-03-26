<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo
    protected $table = 'proveedores';

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'contacto',
        'telefono',
    ];

    // Si tienes relaciones con otros modelos, puedes agregar métodos aquí
    // Por ejemplo, si tienes una relación con productos:
    // public function productos()
    // {
    //     return $this->hasMany(Producto::class);
    // }
}
