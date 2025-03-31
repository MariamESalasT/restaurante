@extends('layouts.app')

@section('content')
    <div style="text-align: center;">
        <h1>Detalles del Usuario</h1>

        <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
        <p><strong>Apellido Paterno:</strong> {{ $usuario->ap_paterno }}</p>
        <p><strong>Apellido Materno:</strong> {{ $usuario->ap_materno }}</p>
        <p><strong>Email:</strong> {{ $usuario->email }}</p>
        <p><strong>Rol:</strong> {{ $usuario->rol }}</p>

        <a href="{{ route('usuarios.index') }}">
            <button type="button">Volver al listado de usuarios</button>
        </a>
    </div>
@endsection
