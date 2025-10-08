<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        // Buscar si ya existe un producto con el mismo nombre (case-insensitive)
        $productoExistente = Producto::whereRaw('LOWER(nombre) = ?', [strtolower($request->nombre)])->first();

        if ($productoExistente) {
            // Si existe, sumar el stock
            $productoExistente->stock += $request->stock;
            $productoExistente->save();

            return redirect()->route('producto.index')
                ->with('success', 'El producto ya existía. Se sumó el stock. Stock total: ' . $productoExistente->stock);
        }

        // Si no existe, crear el nuevo producto
        $data = $request->only(['nombre','stock']);
        Producto::create($data);

        return redirect()->route('producto.index')->with('success','Producto creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('producto.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $producto->update($request->only(['nombre','stock']));

        return redirect()->route('producto.index')->with('success','Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        Producto::where('id', $producto->id)->delete();
        return redirect()->route('producto.index')->with('success','Producto eliminado correctamente');
    }
}
