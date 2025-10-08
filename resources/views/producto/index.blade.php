@extends('layouts.app')
@section('content')

<h1>Lista de Productos</h1>
<a href="{{ route('producto.create') }}">Crear Nuevo Producto</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>id</th>
            <th>nombre</th>
            <th>stock</th>
            <th>acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nombre }}</td>
            <td>{{ $p->stock }}</td>
            <td>
                <form action="{{ route('producto.destroy', $p) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
                <a href="{{ route('producto.edit', $p) }}" class="btn btn-warning btn-sm">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
