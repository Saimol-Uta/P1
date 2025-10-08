@extends('layouts.app')
@section('content')

<h1>Lista de Clientes</h1>
<a href="{{route('cliente.create')}}">Crear Nuevo Cliente</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>cedula</th>
            <th>nombre</th>
            <th>apellido</th>
        </tr>
    </thead>
    <tbody></tbody>
        @foreach($cliente as $c)
        <tr>
            <td>{{$c->cedula}}</td>
            <td>{{$c->nombre}}</td>
            <td>{{$c->apellido}}</td>
            <td>
                <form action="{{ route('cliente.destroy', $c) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
                <a href="{{ route('cliente.edit', $c) }}" class="btn btn-warning btn-sm">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection