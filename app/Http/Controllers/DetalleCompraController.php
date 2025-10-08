<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Cliente;

class DetalleCompraController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Search detalle compras by cliente cedula.
     */
    public function searchByCedula(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string'
        ]);

        $cedula = $request->input('cedula');

        // Buscar cliente
        $clienteUnico = Cliente::find($cedula);
        
        // Obtener todos los clientes para la lista
        $cliente = Cliente::all();

        // Si el cliente no existe, mostrar mensaje de error
        if (!$clienteUnico) {
            return view('Cliente.index', [
                'cliente' => $cliente,
                'error' => 'Cliente no encontrado con la cédula: ' . $cedula
            ]);
        }

        // Obtener detalles de compra usando relaciones de Laravel
        $detalles = DetalleCompra::whereHas('compra', function ($query) use ($cedula) {
            $query->where('cedula_cliente', $cedula);
        })
        ->with(['compra', 'producto'])
        ->get()
        ->map(function ($detalle) {
            return [
                'id' => $detalle->id,
                'id_compra' => $detalle->id_compra,
                'producto' => [
                    'id' => $detalle->producto->id ?? null,
                    'nombre' => $detalle->producto->nombre ?? null,
                    'precio' => $detalle->producto->precio ?? null,
                ],
                'cantidad' => $detalle->cantidad,
            ];
        });

        return view('Cliente.index', [
            'cliente' => $cliente,
            'cliente_buscado' => [
                'cedula' => $clienteUnico->cedula,
                'nombre' => $clienteUnico->nombre,
                'apellido' => $clienteUnico->apellido,
            ],
            'detalles' => $detalles,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DetalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetalleCompra $detalleCompra)
    {
        //
    }
}
