<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'proveedor'])->get();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.index', compact('productos', 'categorias', 'proveedores'));
    }
    

    public function create()
    {
        return redirect()->route('products.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'stock_actual' => 'required|numeric',
            'unidad_medida' => 'required|max:20',
            'fecha_caducidad' => 'required|date',
            'id_categorias' => 'required|exists:categorias,id',
            'id_proveedores' => 'required|exists:proveedores,id',
        ]);

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'stock_actual' => $request->stock_actual,
            'unidad_medida' => $request->unidad_medida,
            'fecha_caducidad' => $request->fecha_caducidad,
            'id_categorias' => $request->id_categorias,
            'id_proveedores' => $request->id_proveedores,
        ]);

        Movimiento::create([
            'tipo' => 'insertar',
            'cantidad' => $producto->stock_actual,
            'fecha' => now(),
            'id_usuarios' => $producto->id_proveedores, // Relacionar con proveedor como "usuario"
            'id_productos' => $producto->id,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado y registrado en movimientos.');
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'proveedor'])->findOrFail($id);
        return response()->json($producto);
    }

    public function edit($id)
    {
        $producto = Producto::with(['categoria', 'proveedor'])->findOrFail($id);
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.editar', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'stock_actual' => 'required|numeric',
            'unidad_medida' => 'required|max:20',
            'fecha_caducidad' => 'required|date',
            'id_categorias' => 'required|exists:categorias,id',
            'id_proveedores' => 'required|exists:proveedores,id',
        ]);

        $producto = Producto::findOrFail($id);
        $stockAntes = $producto->stock_actual;

        $producto->update([
            'nombre' => $request->nombre,
            'stock_actual' => $request->stock_actual,
            'unidad_medida' => $request->unidad_medida,
            'fecha_caducidad' => $request->fecha_caducidad,
            'id_categorias' => $request->id_categorias,
            'id_proveedores' => $request->id_proveedores,
        ]);

        Movimiento::create([
            'tipo' => 'actualizar',
            'cantidad' => abs($request->stock_actual - $stockAntes),
            'fecha' => now(),
            'id_usuarios' => $producto->id_proveedores, // Relacionar con proveedor
            'id_productos' => $producto->id,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado y movimiento registrado.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $cantidad = $producto->stock_actual;

        Movimiento::create([
            'tipo' => 'eliminar',
            'cantidad' => $cantidad,
            'fecha' => now(),
            'id_usuarios' => $producto->id_proveedores, // Relacionar con proveedor
            'id_productos' => $id,
        ]);

        $producto->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado y movimiento registrado.');
    }
}