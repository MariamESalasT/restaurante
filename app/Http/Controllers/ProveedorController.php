<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Mostrar una lista de los proveedores.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Mostrar el formulario para crear un nuevo proveedor.
     */
    public function create()
    {
        // Aquí puedes devolver una vista si es necesario, 
        // pero si estás trabajando con API puedes omitir esto.
    }

    /**
     * Almacenar un nuevo proveedor.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|max:100',
            'contacto' => 'required|max:50',
            'telefono' => 'required|max:50',
        ]);

        // Crear el proveedor en la base de datos
        $proveedor = Proveedor::create([
            'nombre' => $request->nombre,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('providers.index')->with('success', 'Proveedor creado correctamente');
    }

    /**
     * Mostrar un proveedor específico.
     */
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return response()->json($proveedor);
    }

    /**
     * Mostrar el formulario para editar un proveedor específico.
     */
    public function edit($id)
    {
        // Buscar el producto por su ID
        $provider = Proveedor::findOrFail($id);
        return view('proveedores.editar', compact('provider'));
    }

    /**
     * Actualizar un proveedor existente.
     */
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:100',
            'contacto' => 'required|max:50',
            'telefono' => 'required|max:50',
        ]);

        // Actualizar los datos del proveedor
        $proveedor->update([
            'nombre' => $request->nombre,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('providers.index')->with('success', 'Proveedor actualizado correctamente');
    }

    /**
     * Eliminar un proveedor.
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('providers.index')->with('success', 'Proveedor eliminado correctamente');
    }
}
