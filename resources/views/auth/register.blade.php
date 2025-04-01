@extends('layouts.app')

@section('content')
    <div class="register-container">
        <h1>Registro de Usuario</h1>

        @if ($errors->any())
            <p class="error-message">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('auth.register.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="ap_paterno">Apellido Paterno:</label>
                <input type="text" name="ap_paterno" id="ap_paterno" required>
            </div>

            <div class="form-group">
                <label for="ap_materno">Apellido Materno:</label>
                <input type="text" name="ap_materno" id="ap_materno">
            </div>

            <div class="form-group">
                <label for="rol">Rol:</label>
                <select name="rol" id="rol" required>
                    <option value="admin">Administrador</option>
                    <option value="proveedor">Proveedor</option>
                    <option value="cocinero">Cocinero</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="submit-btn">Registrarse</button>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .register-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
@endpush

