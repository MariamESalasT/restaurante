@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: center; align-items: flex-start; flex-direction: column; margin-top: 20px;">
        <h1>Lista de Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" style="margin-bottom: 20px;">Crear Usuario</a>
        <table style="border-collapse: collapse; width: 100%; max-width: 800px; text-align: left;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px;">ID</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Nombre</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Email</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Rol</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $usuario->id }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $usuario->nombre }} {{ $usuario->ap_paterno }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $usuario->email }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $usuario->rol }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <a href="{{ route('usuarios.show', $usuario->id) }}" style="margin-right: 10px;">Ver</a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" style="margin-right: 10px;">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
