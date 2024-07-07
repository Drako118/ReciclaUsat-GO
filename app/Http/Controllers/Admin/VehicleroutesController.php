<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicleroute;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\Routestatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VehicleroutesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleroutes = Vehicleroute::join('vehicles', 'vehicleroutes.vehicle_id', '=', 'vehicles.id')
            ->join('routes', 'vehicleroutes.route_id', '=', 'routes.id')
            ->join('routestatuses', 'vehicleroutes.routestatus_id', '=', 'routestatuses.id')
            ->select('vehicleroutes.id', 'vehicleroutes.date_route', 'vehicleroutes.description', 'vehicles.name as vehicle_name', 'routes.name as route_name', 'routestatuses.name as routestatus_name')
            ->orderBy('vehicleroutes.date_route', 'asc')
            ->get();
        return view('admin.programming.index', compact('vehicleroutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::pluck('name', 'id');
        $routes = Route::pluck('name', 'id');
        return view('admin.programming.create', compact('vehicles', 'routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $vehicleId = $request->vehicle_id;
        $routeId = $request->route_id;

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            Vehicleroute::create([
                'date_route' => $date->format('Y-m-d'),
                'vehicle_id' => $vehicleId,
                'route_id' => $routeId,
                'routestatus_id' => 1,
            ]);
        }

        return redirect()->route('admin.vehicleroutes.index')->with('success', 'Rutas de vehículo registradas');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vehicleroute = Vehicleroute::find($id);
        $routestatuses = Routestatus::pluck('name', 'id');
        return view('admin.programming.edit', compact('vehicleroute', 'routestatuses'));
    }

    public function update(Request $request, $id)
    {
        $vehicleroute = Vehicleroute::find($id);
        $vehicleroute->update($request->only(['description', 'routestatus_id']));
        return redirect()->route('admin.vehicleroutes.index')->with('success', 'Ruta de vehículo actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicleroute = Vehicleroute::find($id);
        $vehicleroute->delete();
        return redirect()->route('admin.vehicleroutes.index')->with('success', 'Ruta de vehículo eliminada');
    }
}
