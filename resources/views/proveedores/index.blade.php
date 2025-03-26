@extends('layouts.app')

@section('title', 'Gestión de Proveedores')

@section('content')
    <div class="container">
        <h2>Gestión de Proveedores</h2>

        {{-- Mensajes de éxito o error --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Botón para mostrar/ocultar el formulario de agregar un nuevo proveedor --}}
        <button class="btn btn-primary mb-3" onclick="toggleFormularioProveedor()">Agregar Nuevo Proveedor</button>

        {{-- Formulario para agregar un nuevo proveedor (oculto por defecto) --}}
        <div id="formProveedor" class="card mb-4" style="display: none;">
            <div class="card-header">
                <h4>Agregar Nuevo Proveedor</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('providers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="contacto">Contacto</label>
                        <input type="text" name="contacto" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="number" name="telefono" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Proveedor</button>
                </form>
            </div>
        </div>

        {{-- Lista de proveedores --}}
        <div class="card">
            <div class="card-header">
                <h4>Lista de Proveedores</h4>
            </div>
            <div class="card-body">
                @if($proveedores->isEmpty())
                    <p>No hay proveedores registrados.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedores as $proveedor)
                                <tr>
                                    <td>{{ $proveedor->id }}</td>
                                    <td>{{ $proveedor->nombre }}</td>
                                    <td>{{ $proveedor->contacto }}</td>
                                    <td>{{ $proveedor->telefono }}</td>
                                    <td>
                                        {{-- Botón para editar --}}
                                        <a href="{{ route('providers.edit', $proveedor->id) }}"
                                            class="btn btn-warning btn-sm">Editar</a>

                                        {{-- Botón para eliminar --}}
                                        <form action="{{ route('providers.destroy', $proveedor->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    {{-- Script para mostrar/ocultar el formulario --}}
    <script>
        function toggleFormularioProveedor() {
            const formProveedor = document.getElementById('formProveedor');
            formProveedor.style.display = formProveedor.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection