<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Exception;
use Illuminate\Http\Request;

class MaintenancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('admin.maintenances.index', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.maintenances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Maintenance::create($request->all());
        return redirect()->route('admin.maintenances.index')->with('success', 'Mantenimiento registrado');
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
        $maintenance = Maintenance::find($id);
        return view('admin.maintenances.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->update($request->all());
        return redirect()->route('admin.maintenances.index')->with('success', 'Mantenimiento actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $maintenance = Maintenance::find($id);
            $maintenance->delete();
        } catch (Exception $e) {
            return redirect()->route('admin.maintenances.index')->with('error', 'Error al eliminar el mantenimiento por que tiene horarios asignados');
        }
        return redirect()->route('admin.maintenances.index')->with('success', 'Mantenimiento eliminado');
    }
}
