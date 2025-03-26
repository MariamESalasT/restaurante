<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    /**
     * Mostrar una lista de todas las alertas.
     */
    public function index()
    {
        // Obtener todas las alertas
        $alertas = Alerta::all();
        return response()->json($alertas);
    }

    /**
     * Mostrar el formulario para crear una nueva alerta.
     */
    public function create()
    {
        // Si usas vistas, puedes retornar una vista para mostrar el formulario
        // return view('alertas.create');

        // Para una API, generalmente no es necesario un formulario
    }

    /**
     * Almacenar una nueva alerta.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'tipo' => 'required|max:20',
            'fecha_generacion' => 'required|date',
            'estado' => 'required|max:15',
            'id_productos' => 'nullable|exists:productos,id', // Si se usa la relación con productos
        ]);

        // Crear la alerta en la base de datos
        $alerta = Alerta::create([
            'tipo' => $request->tipo,
            'fecha_generacion' => $request->fecha_generacion,
            'estado' => $request->estado,
            'id_productos' => $request->id_productos, // Si se usa la relación con productos
        ]);

        return response()->json($alerta, 201);
    }

    /**
     * Mostrar una alerta específica.
     */
    public function show($id)
    {
        // Buscar la alerta por su ID
        $alerta = Alerta::findOrFail($id);
        return response()->json($alerta);
    }

    /**
     * Mostrar el formulario para editar una alerta específica.
     */
    public function edit($id)
    {
        // Si usas vistas, puedes devolverla para editar la alerta
        // return view('alertas.edit', compact('alerta'));
    }

    /**
     * Actualizar una alerta existente.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'tipo' => 'required|max:20',
            'fecha_generacion' => 'required|date',
            'estado' => 'required|max:15',
            'id_productos' => 'nullable|exists:productos,id', // Si se usa la relación con productos
        ]);

        // Buscar la alerta por su ID
        $alerta = Alerta::findOrFail($id);

        // Actualizar los datos de la alerta
        $alerta->update([
            'tipo' => $request->tipo,
            'fecha_generacion' => $request->fecha_generacion,
            'estado' => $request->estado,
            'id_productos' => $request->id_productos, // Si se usa la relación con productos
        ]);

        return response()->json($alerta);
    }

    /**
     * Eliminar una alerta.
     */
    public function destroy($id)
    {
        // Buscar y eliminar la alerta
        $alerta = Alerta::findOrFail($id);
        $alerta->delete();

        return response()->json(['message' => 'Alerta eliminada correctamente']);
    }
}

