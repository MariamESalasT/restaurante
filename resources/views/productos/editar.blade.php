@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto</h2>

    <form action="{{ route('products.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="stock_actual">Stock Actual</label>
            <input type="number" name="stock_actual" class="form-control" value="{{ old('stock_actual', $producto->stock_actual) }}" required>
        </div>

        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <input type="text" name="unidad_medida" class="form-control" value="{{ old('unidad_medida', $producto->unidad_medida) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_caducidad">Fecha de Caducidad</label>
            <input type="date" name="fecha_caducidad" class="form-control" value="{{ old('fecha_caducidad', $producto->fecha_caducidad) }}" required>
        </div>

        <div class="form-group">
            <label for="id_categorias">Categoría</label>
            <select name="id_categorias" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->id_categorias == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_proveedores">Proveedor</label>
            <select name="id_proveedores" class="form-control" required>
                <option value="">Seleccione un proveedor</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ $producto->id_proveedores == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>
</div>
@endsection
