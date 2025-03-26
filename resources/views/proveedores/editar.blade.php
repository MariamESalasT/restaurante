@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Proveedor</h2>

        {{-- Mensajes de éxito o error --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulario para editar un proveedor --}}
        <div class="card">
            <div class="card-header">
                <h4>Editar Información del Proveedor</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('providers.update', $provider->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $provider->nombre }}" required>
                    </div>

                    <div class="form-group">
                        <label for="contacto">Contacto</label>
                        <input type="text" name="contacto" class="form-control" value="{{ $provider->contacto }}" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ $provider->telefono }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="{{ route('providers.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection