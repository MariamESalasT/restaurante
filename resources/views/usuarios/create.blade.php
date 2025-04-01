@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: center;">
        <div>
            <h1>Crear Usuario</h1>
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="nombre" required>
                </div>

                <div>
                    <label>Apellido Paterno:</label>
                    <input type="text" name="ap_paterno" required>
                </div>

                <div>
                    <label>Apellido Materno:</label>
                    <input type="text" name="ap_materno">
                </div>

                <div>
                    <label>Rol:</label>
                    <input type="text" name="rol" required>
                </div>

                <div>
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>

                <div>
                    <label>Contraseña:</label>
                    <input type="password" name="password" required>
                </div>

                <div>
                    <button type="submit">Crear Usuario</button>
                </div>
            </form>

            <br>
            <a href="{{ route('usuarios.index') }}">
                <button type="button">Volver al listado de usuarios</button>
            </a>
        </div>
    </div>
@endsection
