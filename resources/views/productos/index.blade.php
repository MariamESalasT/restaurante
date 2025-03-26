@extends('layouts.app')

@section('title', 'Gestión de Productos y Categorías')

@section('content')
    <div class="container">
        <h1>Gestión de Productos y Categorías</h1>

        {{-- Botón para agregar un nuevo producto --}}
        <button class="btn btn-primary my-3" onclick="mostrarFormularioProducto()">Agregar Producto</button>

        {{-- Formulario de nuevo producto (oculto por defecto) --}}
        <div id="formProducto" class="card p-3 mb-4" style="display: none;">
            <h3>Nuevo Producto</h3>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="stock_actual" class="form-label">Stock</label>
                    <input type="number" step="0.01" name="stock_actual" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                    <input type="text" name="unidad_medida" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_caducidad" class="form-label">Fecha de Caducidad</label>
                    <input type="date" name="fecha_caducidad" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="id_categorias" class="form-label">Categoría</label>
                    <select name="id_categorias" class="form-control">
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_proveedores" class="form-label">Proveedor</label>
                    <select name="id_proveedores" class="form-control">
                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Guardar Producto</button>
            </form>
        </div>

        {{-- Tabla de productos --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Unidad</th>
                    <th>Fecha de Caducidad</th>
                    <th>Categoría</th>
                    <th>Proveedor</th> {{-- Columna de proveedor --}}
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->stock_actual }}</td>
                        <td>{{ $producto->unidad_medida }}</td>
                        <td>{{ $producto->fecha_caducidad }}</td>
                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>{{ $producto->proveedor->nombre }}</td> {{-- Mostrar el nombre del proveedor --}}
                        <td>
                            <a href="{{ route('products.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        {{-- Gestión de categorías --}}
        <h2>Gestión de Categorías</h2>
        <button class="btn btn-secondary my-3" onclick="mostrarFormularioCategoria()">Agregar Categoría</button>

        {{-- Formulario de nueva categoría --}}
        <div id="formCategoria" class="card p-3 mb-4" style="display: none;">
            <h3>Nueva Categoría</h3>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Guardar Categoría</button>
            </form>
        </div>

        {{-- Tabla de categorías --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('categories.destroy', $categoria->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar categoría?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Scripts para mostrar formularios --}}
    <script>
        function mostrarFormularioProducto() {
            document.getElementById('formProducto').style.display = 'block';
        }
        function mostrarFormularioCategoria() {
            document.getElementById('formCategoria').style.display = 'block';
        }
    </script>
@endsection