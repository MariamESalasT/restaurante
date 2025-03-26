<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo (si el nombre de la tabla no sigue la convención)
    protected $table = 'productos';

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'stock_actual',
        'unidad_medida',
        'fecha_caducidad',
        'id_categorias',
        'id_proveedores',
    ];

    // Definir relaciones con otros modelos, si las claves foráneas están habilitadas en la migración

    /**
     * Relación con la categoría del producto
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categorias');
    }

    /**
     * Relación con el proveedor del producto
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedores');
    }
}
