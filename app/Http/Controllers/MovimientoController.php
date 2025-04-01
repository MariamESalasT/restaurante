<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Producto;

class MovimientoController extends Controller
{
    public function index(Request $request)
    {
        $query = Movimiento::query();

        // Filtro por tipo de movimiento
        if ($request->has('tipo') && in_array($request->tipo, ['insertar', 'actualizar', 'eliminar'])) {
            $query->where('tipo', $request->tipo);
        }

        // Otros filtros (por producto)
        if ($request->has('producto') && $request->producto != '') {
            $query->whereHas('producto', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->producto . '%');
            });
        }

        // Obtener los movimientos con los filtros aplicados
        $movimientos = $query->with('producto')->get();

        return view('inventario.index', compact('movimientos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'producto_nombre' => 'required|string',
            'cantidad' => 'required|numeric|min:1',
            'unidad_medida' => 'required|string|max:20',
            'tipo' => 'required|in:entrada,salida',
        ]);

        $producto = Producto::whereRaw('LOWER(nombre) = ?', [strtolower($request->producto_nombre)])->first();

        if (!$producto) {
            $producto = Producto::create([
                'nombre' => $request->producto_nombre,
                'stock_actual' => 0,
                'unidad_medida' => $request->unidad_medida,
                'fecha_caducidad' => now()->addMonths(6)->toDateString(),
                'id_categorias' => 1,
                'id_proveedores' => 1
            ]);
        }

        if ($request->tipo == 'entrada') {
            $producto->stock_actual += $request->cantidad;
            $producto->save();
        } else {
            if ($request->cantidad > $producto->stock_actual) {
                return back()->with('error', 'No hay suficiente stock para la salida.');
            }

            if ($request->cantidad == $producto->stock_actual) {
                $producto->delete();
                session()->flash('message', 'Producto eliminado porque el stock llegó a 0.');
            } else {
                $producto->stock_actual -= $request->cantidad;
                $producto->save();
            }
        }

        Movimiento::create([
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'fecha' => now(),
            'id_productos' => $producto->id,
        ]);

        return redirect()->route('inventario.index')->with('success', 'Movimiento registrado correctamente.');
    }
}


