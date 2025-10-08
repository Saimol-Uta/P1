@extends('layouts.app')

@section('content')
    <h1>Registrar Nueva Compra</h1>

    @if ($errors->any())
        <article style="background-color: #ffcccc; color: #cc0000;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </article>
    @endif

    <form action="{{ route('compra.store') }}" method="POST">
        @csrf
        <label for="cedula_cliente">Cliente</label>
        <select name="cedula_cliente" id="cedula_cliente" required>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->cedula }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
            @endforeach
        </select>

        <label for="id_producto">Producto</label>
        <select name="id_producto" id="id_producto" required>
            @foreach ($productos as $producto)
                <option value="{{ $producto->id }}">{{ $producto->nombre }} (Stock: {{ $producto->stock }})</option>
            @endforeach
        </select>
        
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" min="1" required>

        <button type="submit">Registrar Compra</button>
    </form>
@endsection