@extends('layouts.app')
@section('content')
    <h1>Editar Cliente</h1>
    <form action="{{ route('cliente.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula:</label>
            <input type="text" id="cedula" name="cedula" class="form-control" value="{{ $cliente->cedula }}" readonly>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $cliente->apellido }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </form>

@endsection