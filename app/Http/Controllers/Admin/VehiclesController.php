<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Brandmodel;
use App\Models\Vehicle;
use App\Models\Vehiclecolor;
use App\Models\Vehicletypes;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        $vehicles = Vehicle::select(
            'vehicles.*',
            'brands.name as brand_name',
            'brandmodels.name as model_name',
            'vehicletypes.name as type_name',
            'vehiclecolors.name as color_name'
        )
        ->join('brands', 'vehicles.brand_id', '=', 'brands.id')
        ->join('brandmodels', 'vehicles.model_id', '=', 'brandmodels.id')
        ->join('vehicletypes', 'vehicles.type_id', '=', 'vehicletypes.id')
        ->join('vehiclecolors', 'vehicles.color_id', '=', 'vehiclecolors.id')
        ->get();

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::pluck('name', 'id');

        $brandSQL = Brand::all()->first();

        $models = Brandmodel::where('brand_id', $brandSQL->id)->pluck('name', 'id');
        $colors = Vehiclecolor::pluck('name', 'id');
        $types = Vehicletypes::pluck('name', 'id');

        return view('admin.vehicles.create', compact('brands','models','colors','types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->all());
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehiculo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle = Vehicle::find($id);
        $brands = Brand::pluck('name', 'id');
        $models = Brandmodel::pluck('name', 'id');
        $colors = Vehiclecolor::pluck('name', 'id');
        $types = Vehicletypes::pluck('name', 'id');
        return view('admin.vehicles.edit', compact('vehicle', 'brands', 'models', 'colors', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->update($request->all());
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo eliminado');
    }
}
