<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

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

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
    }

    public function update(Request $request, $id)
        {
            $usuario = User::find($id);

            if (!$usuario) {
                return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado');
            }

            $request->validate([
                'nombre' => 'required|string|max:100',
                'ap_paterno' => 'required|string|max:50',
                'ap_materno' => 'nullable|string|max:50',
                'rol' => 'required|string|in:admin,proveedor,cocinero',
                'email' => 'required|string|email|max:100|unique:usuarios,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional y validación de confirmación
            ]);

            // Actualizamos los campos del usuario
            $usuario->nombre = $request->nombre;
            $usuario->ap_paterno = $request->ap_paterno;
            $usuario->ap_materno = $request->ap_materno;
            $usuario->rol = $request->rol;
            $usuario->email = $request->email;

            // Si la contraseña es proporcionada, se actualiza
            if ($request->password) {
                $usuario->password = Hash::make($request->password);
            }

            // Guardamos los cambios
            $usuario->save();

    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito');
}

    public function destroy($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito');
    }

    public function show($id)
    {   
        $usuario = User::find($id); // Buscar el usuario por su ID
        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
    }
         return view('usuarios.show', compact('usuario')); // Retornar la vista con el usuario encontrado
    }

    public function edit($id)
    {
        $usuario = User::find($id); // Buscar el usuario por su ID
        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }
        return view('usuarios.edit', compact('usuario')); // Retornar la vista de edición con los datos del usuario
    }

    public function create()
    {
        return view('usuarios.create'); 
    }


}
