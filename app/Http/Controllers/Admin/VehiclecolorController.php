<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiclecolor;
use Illuminate\Http\Request;

class VehiclecolorController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiclecolors = Vehiclecolor::all();
        return view('admin.vehiclecolors.index', compact('vehiclecolors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehiclecolors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Vehiclecolor::create($request->all());
        return redirect()->route('admin.vehiclecolors.index')->with('success', 'Color de vehículo registrado');
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
        $vehiclecolor = Vehiclecolor::find($id);
        return view('admin.vehiclecolors.edit', compact('vehiclecolor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehiclecolor = Vehiclecolor::find($id);
        $vehiclecolor->update($request->all());
        return redirect()->route('admin.vehiclecolors.index')->with('success', 'Color de vehículo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehiclecolor = Vehiclecolor::find($id);
        $vehiclecolor->delete();
        return redirect()->route('admin.vehiclecolors.index')->with('success', 'Color de vehículo eliminado');
    }
}
