<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\User;
use App\Models\Producto;

class MovimientoController extends Controller
{
    /**
     * Muestra todos los movimientos.
     */
    public function index()
    {
        $movimientos = Movimiento::with(['usuario', 'producto'])->get();
        return response()->json($movimientos);
    }

    /**
     * Guarda un nuevo movimiento en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:50',
            'cantidad' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'id_usuarios' => 'required|exists:usuarios,id',
            'id_productos' => 'required|exists:productos,id'
        ]);

        $movimiento = Movimiento::create($request->all());

        return response()->json([
            'message' => 'Movimiento registrado con éxito',
            'data' => $movimiento
        ], 201);
    }

    /**
     * Muestra un movimiento específico.
     */
    public function show($id)
    {
        $movimiento = Movimiento::with(['usuario', 'producto'])->findOrFail($id);
        return response()->json($movimiento);
    }

    /**
     * Actualiza un movimiento existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'string|max:50',
            'cantidad' => 'numeric|min:0',
            'fecha' => 'date',
            'id_usuarios' => 'exists:usuarios,id',
            'id_productos' => 'exists:productos,id'
        ]);

        $movimiento = Movimiento::findOrFail($id);
        $movimiento->update($request->all());

        return response()->json([
            'message' => 'Movimiento actualizado con éxito',
            'data' => $movimiento
        ]);
    }

    /**
     * Elimina un movimiento.
     */
    public function destroy($id)
    {
        $movimiento = Movimiento::findOrFail($id);
        $movimiento->delete();

        return response()->json(['message' => 'Movimiento eliminado con éxito']);
    }
}
