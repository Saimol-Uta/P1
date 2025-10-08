<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::where('stock', '>', 0)->get();
        return view('compra.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
       public function store(Request $request)
    {
        $request->validate([
            'cedula_cliente' => 'required|exists:clientes,cedula',
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);
        
        $producto = Producto::find($request->id_producto);
        if ($producto->stock < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock.']);
        }

        DB::transaction(function () use ($request, $producto) {
            $compra = Compra::create([
                'cedula_cliente' => $request->cedula_cliente,
            ]);

            DetalleCompra::create([
                'id_compra' => $compra->id,
                'id_producto' => $request->id_producto,
                'cantidad' => $request->cantidad,
            ]);

            $producto->stock -= $request->cantidad;
            $producto->save();
        });

        return redirect()->route('producto.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
