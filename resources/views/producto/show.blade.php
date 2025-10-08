@extends('layouts.app')
@section('content')
    <h1>Ver Producto</h1>
    <p><strong>ID:</strong> {{ $producto->id }}</p>
    <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
    <p><strong>Stock:</strong> {{ $producto->stock }}</p>

    <a href="{{ route('produtos.edit', $producto) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Volver</a>
@endsection
