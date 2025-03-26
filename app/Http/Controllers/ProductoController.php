<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Mostrar una lista de los productos.
     */
    public function index()
    {
        // Obtener todos los productos con sus relaciones
        $productos = Producto::with(['categoria', 'proveedor'])->get();
        $categorias = Categoria::all(); // Obtener todas las categorías para el select
        $proveedores = Proveedor::all(); // Obtener todos los proveedores para el select
        return view('productos.index', compact('productos', 'categorias', 'proveedores'));
    }


    /**
     * Mostrar el formulario para crear un nuevo producto.
     */
    public function create()
    {
        // Si usas vistas, puedes retornar una vista para mostrar el formulario
        return redirect()->route('products.index');

        // Para una API, generalmente no es necesario un formulario, ya que
        // se trabajaría con peticiones JSON.
    }

    /**
     * Almacenar un nuevo producto.
     */
    public function store(Request $request)
    {

        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|max:100',
            'stock_actual' => 'required|numeric',
            'unidad_medida' => 'required|max:20',
            'fecha_caducidad' => 'required|date',
            'id_categorias' => 'required|exists:categorias,id',
            'id_proveedores' => 'required|exists:proveedores,id',
        ]);


        // Crear el producto en la base de datos
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'stock_actual' => $request->stock_actual,
            'unidad_medida' => $request->unidad_medida,
            'fecha_caducidad' => $request->fecha_caducidad,
            'id_categorias' => $request->id_categorias,
            'id_proveedores' => $request->id_proveedores,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente');
    }

    /**
     * Mostrar un producto específico.
     */
    public function show($id)
    {
        // Buscar el producto con sus relaciones (categoria y proveedor)
        $producto = Producto::with(['categoria', 'proveedor'])->findOrFail($id);
        return response()->json($producto);
    }

    /**
     * Mostrar el formulario para editar un producto específico.
     */
    public function edit($id)
    {
        // Buscar el producto por su ID
        $producto = Producto::with(['categoria', 'proveedor'])->findOrFail($id);
        $categorias = Categoria::all(); // Obtener todas las categorías para el select
        $proveedores = Proveedor::all(); // Obtener todos los proveedores para el select

        // Retornar la vista con el producto, las categorías y proveedores
        return view('productos.editar', compact('producto', 'categorias', 'proveedores'));
    }

    /**
     * Actualizar un producto existente.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:100',
            'stock_actual' => 'required|numeric',
            'unidad_medida' => 'required|max:20',
            'fecha_caducidad' => 'required|date',
            'id_categorias' => 'required|exists:categorias,id',
            'id_proveedores' => 'required|exists:proveedores,id',
        ]);

        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);

        // Actualizar los datos del producto
        $producto->update([
            'nombre' => $request->nombre,
            'stock_actual' => $request->stock_actual,
            'unidad_medida' => $request->unidad_medida,
            'fecha_caducidad' => $request->fecha_caducidad,
            'id_categorias' => $request->id_categorias,
            'id_proveedores' => $request->id_proveedores,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Eliminar un producto.
     */
    public function destroy($id)
    {
        // Buscar y eliminar el producto
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
    }
}
