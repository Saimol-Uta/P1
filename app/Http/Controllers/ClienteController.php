<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource, en este metodo se muestra una lista de recursos
     * A qui se obtiene todos los clientes
     */
    public function index()
    {
        // Obtener todos los clientes
        $cliente = Cliente::all();
        return view("cliente.index", compact("cliente"));
    }

    /**
     * Show the form for creating a new resource.
     * aqui se muestra el formulario para crear un nuevo recurso
     */
    public function create()
    {
        return view("cliente.create");
    }

    /**
     * Store a newly created resource in storage.
     * aqui se guarda el recurso nuevo en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|unique:clientes,cedula|max:10',
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
        ]);


        $data = $request->only(['cedula','nombre','apellido']);
        Cliente::create($data);

        // La ruta registrada en routes/web.php es 'cliente.index'
        return redirect()->route('cliente.index')->with('success','Cliente creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * a qui se muestra el formulario para editar un recurso existente
     */
    public function edit(Cliente $cliente)
    {
        return view("cliente.edit", compact("cliente"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente = Cliente::find($cliente->cedula);
        $cliente->update($request->all());
        return redirect()->route('cliente.index')->with('success','Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
    $cliente = Cliente::find($cliente->cedula);
    $cliente->delete();
    return redirect()->route('cliente.index')->with('success','Cliente eliminado exitosamente');
    }
}
