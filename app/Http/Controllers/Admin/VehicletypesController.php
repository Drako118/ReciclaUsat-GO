<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicletype;
use App\Models\Vehicletypes;
use Illuminate\Http\Request;

class VehicletypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicletypes = Vehicletypes::all();
        return view('admin.vehicletypes.index', compact('vehicletypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicletypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Vehicletypes::create($request->all());
        return redirect()->route('admin.vehicletypes.index')->with('success', 'Tipo de vehículo registrado');
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
        $vehicletype = Vehicletypes::find($id);
        return view('admin.vehicletypes.edit', compact('vehicletype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicletype = Vehicletypes::find($id);
        $vehicletype->update($request->all());
        return redirect()->route('admin.vehicletypes.index')->with('success', 'Tipo de vehículo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicletype = Vehicletypes::find($id);
        $vehicletype->delete();
        return redirect()->route('admin.vehicletypes.index')->with('success', 'Tipo de vehículo eliminado');
    }
}
