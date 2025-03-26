<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Mostrar una lista de todas las categorías.
     */
    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    /**
     * Mostrar el formulario para crear una nueva categoría.
     */
    public function create()
    {
        // Si usas vistas, puedes retornar una vista para mostrar el formulario
        // return view('categorias.create');

        // Para una API, generalmente no es necesario un formulario, ya que
        // se trabajaría con peticiones JSON.
    }

    /**
     * Almacenar una nueva categoría.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'required',
        ]);

        // Crear la categoría en la base de datos
        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json($categoria, 201);
    }

    /**
     * Mostrar una categoría específica.
     */
    public function show($id)
    {
        // Buscar la categoría por su ID
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria);
    }

    /**
     * Mostrar el formulario para editar una categoría específica.
     */
    public function edit($id)
    {
        // Si estás usando una vista, puedes devolverla para editar la categoría
        // return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar una categoría existente.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:50',
            'descripcion' => 'required',
        ]);

        // Buscar la categoría por su ID
        $categoria = Categoria::findOrFail($id);

        // Actualizar los datos de la categoría
        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json($categoria);
    }

    /**
     * Eliminar una categoría.
     */
    public function destroy($id)
    {
        // Buscar y eliminar la categoría
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente']);
    }
}

