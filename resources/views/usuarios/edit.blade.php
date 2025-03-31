@extends('layouts.app')

@section('content')
    <h1>Editar Usuario</h1>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ $usuario->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="ap_paterno">Apellido Paterno:</label>
            <input type="text" name="ap_paterno" id="ap_paterno" value="{{ $usuario->ap_paterno }}" required>
        </div>

        <div class="form-group">
            <label for="ap_materno">Apellido Materno:</label>
            <input type="text" name="ap_materno" id="ap_materno" value="{{ $usuario->ap_materno }}">
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol" id="rol" required>
                <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="proveedor" {{ $usuario->rol == 'proveedor' ? 'selected' : '' }}>Proveedor</option>
                <option value="cocinero" {{ $usuario->rol == 'cocinero' ? 'selected' : '' }}>Cocinero</option>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $usuario->email }}" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password">
            <p class="note">Deja en blanco si no deseas cambiar la contraseña.</p>
        </div>

        <div class="form-group">
            <button type="submit">Actualizar Usuario</button>
        </div>
    </form>
@endsection

