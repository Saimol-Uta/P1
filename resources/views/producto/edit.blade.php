@extends('layouts.app')
@section('content')
    <h1>Editar Producto</h1>
    <form action="{{ route('producto.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <input type="number" id="stock" name="stock" class="form-control" value="{{ $producto->stock }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>

@endsection
