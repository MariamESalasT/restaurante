@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Categoría</h2>

    <!-- Formulario para editar la categoría -->
    <form action="{{ route('categories.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre de la Categoría</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $categoria->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $categoria->descripcion) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
    </form>
</div>
@endsection
