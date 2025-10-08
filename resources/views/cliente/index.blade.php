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
<h2>Buscar Pedidos por Cliente (por cédula)</h2>
<form action="{{ route('DetalleCompra.searchByCedula') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <input type="text" name="cedula" class="form-control" placeholder="Cédula del Cliente" required>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>

@if(isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif

@if(isset($cliente_buscado) && isset($detalles))
    <h3>Resultados para: {{ $cliente_buscado['nombre'] }} {{ $cliente_buscado['apellido'] }} ({{ $cliente_buscado['cedula'] }})</h3>
    @if(count($detalles) > 0)
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID Detalle</th>
                    <th>ID Compra</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalles as $d)
                <tr>
                    <td>{{ $d['id'] }}</td>
                    <td>{{ $d['id_compra'] }}</td>
                    <td>{{ $cliente_buscado['nombre'] }} {{ $cliente_buscado['apellido'] }}</td>
                    <td>{{ $d['producto']['nombre'] ?? '—' }}</td>
                    <td>{{ $d['cantidad'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No se encontraron pedidos para este cliente.</p>
    @endif
@endif
@endsection