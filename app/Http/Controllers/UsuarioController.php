<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar la lista de usuarios.
     */
    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }

    /**
     * Guardar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'ap_paterno' => 'required|string|max:50',
            'ap_materno' => 'nullable|string|max:50',
            'rol' => 'required|string|max:20',
            'email' => 'required|string|email|max:100|unique:usuarios,email',
            'password' => 'required|string|min:8',
        ]);

        $usuario = User::create([
            'nombre' => $request->nombre,
            'ap_paterno' => $request->ap_paterno,
            'ap_materno' => $request->ap_materno,
            'rol' => $request->rol,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Usuario creado con éxito', 'usuario' => $usuario], 201);
    }

    /**
     * Mostrar un usuario específico.
     */
    public function show($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario);
    }

    /**
     * Actualizar un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|string|max:100',
            'ap_paterno' => 'sometimes|string|max:50',
            'ap_materno' => 'nullable|string|max:50',
            'rol' => 'sometimes|string|max:20',
            'email' => 'sometimes|string|email|max:100|unique:usuarios,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $usuario->update([
            'nombre' => $request->nombre ?? $usuario->nombre,
            'ap_paterno' => $request->ap_paterno ?? $usuario->ap_paterno,
            'ap_materno' => $request->ap_materno ?? $usuario->ap_materno,
            'rol' => $request->rol ?? $usuario->rol,
            'email' => $request->email ?? $usuario->email,
            'password' => $request->password ? Hash::make($request->password) : $usuario->password,
        ]);

        return response()->json(['message' => 'Usuario actualizado con éxito', 'usuario' => $usuario]);
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado con éxito']);
    }
}
