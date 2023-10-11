<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();

        return Inertia::render('Clientes/ClientesLista',['clientes' => $clientes]);
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
        $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'email' => 'required|unique:clientes,email',
            'provincia' => 'required|max:50',
            'telefono' => 'required|max:12',
            'direccion'=> 'required|max:120'
        ]);

        $cliente = new Cliente($request->input());
        $cliente->save();

        return redirect('clientes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {

        $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'email' => 'required|email',
            'provincia' => 'required|max:50',
            'telefono' => 'required|max:12',
            'direccion'=> 'required|max:120'
        ]);

        $cliente->update($request->input());

        return redirect('clientes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect('clientes');
    }
}
