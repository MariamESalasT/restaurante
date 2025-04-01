<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('usuarios.index')->with('success', 'Bienvenido!');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Registrar usuario y redirigir a usuarios.index
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ap_paterno' => 'required|string|max:255',
            'ap_materno' => 'nullable|string|max:255',
            'rol' => 'required|string|in:admin,proveedor,cocinero', 
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Confirmación de contraseña
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'ap_paterno' => $request->ap_paterno,
            'ap_materno' => $request->ap_materno,
            'rol' => $request->rol,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // Iniciar sesión automáticamente después de registrar
        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado correctamente');
    }
}




