<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo (si el nombre de la tabla no sigue la convención)
    protected $table = 'categorias';

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relación con los productos (si hay productos que pertenecen a esta categoría)
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categorias');
    }
}
