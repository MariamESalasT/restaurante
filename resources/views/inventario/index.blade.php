@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Inventario y Movimientos</h1>

        {{-- Mensajes de estado --}}
        @if (session('message'))
            <p style="color: red; margin-top: 10px;">{{ session('message') }}</p>
        @endif

        @if (session('success'))
            <p style="color: green; margin-top: 10px;">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p style="color: red; margin-top: 10px;">{{ session('error') }}</p>
        @endif

        <script>
            setTimeout(() => {
                const alertMessage = document.querySelector('p[style*="red"]');
                const alertSuccess = document.querySelector('p[style*="green"]');
                if (alertMessage) alertMessage.remove();
                if (alertSuccess) alertSuccess.remove();
            }, 3000);
        </script>

        <hr>

        {{-- Filtros --}}
        <form method="GET" action="{{ route('inventario.index') }}">
            <input type="text" name="producto" placeholder="Buscar producto" value="{{ request('producto') }}">
            <select name="tipo">
                <option value="">Todos los tipos</option>
                <option value="insertar" {{ request('tipo') == 'insertar' ? 'selected' : '' }}>Insertar</option>
                <option value="actualizar" {{ request('tipo') == 'actualizar' ? 'selected' : '' }}>Actualizar</option>
                <option value="eliminar" {{ request('tipo') == 'eliminar' ? 'selected' : '' }}>Eliminar</option>
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <hr>

        {{-- Historial de movimientos --}}
        <h2>Historial</h2>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movimientos as $mov)
                    <tr>
                        <td>{{ $mov->fecha }}</td>
                        <td>{{ $mov->producto->nombre ?? 'Desconocido' }}</td>
                        <td>{{ $mov->cantidad }}</td>
                        <td>{{ $mov->tipo }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No se encontraron movimientos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
