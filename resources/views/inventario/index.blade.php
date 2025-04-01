@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Inventario y Movimientos</h1>

    {{-- Formulario para registrar movimiento --}}
    <form method="POST" action="{{ route('inventario.actualizar') }}">
        @csrf
        <div>
            <label>Producto (nombre):</label>
            <input type="text" name="producto_nombre" required>
        </div>
        <div>
            <label>Cantidad:</label>
            <input type="number" name="cantidad" required>
        </div>
        <div>
            <label>Unidad de Medida:</label>
            <input type="text" name="unidad_medida" required placeholder="Piezas, Kg, Lts">
        </div>
        <div>
            <label>Tipo:</label>
            <select name="tipo">
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
            </select>
        </div>
        <button type="submit">Actualizar stock</button>
    </form>

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
            <option value="entrada" {{ request('tipo') == 'entrada' ? 'selected' : '' }}>Entrada</option>
            <option value="salida" {{ request('tipo') == 'salida' ? 'selected' : '' }}>Salida</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <hr>

    {{-- Tabla de stock --}}
    <!-- <h2>Stock actual</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Unidad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->stock_actual }}</td>
                    <td>{{ $producto->unidad_medida }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table> -->

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



