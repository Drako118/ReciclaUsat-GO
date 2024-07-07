<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Maintenance;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($maintenanceId)
    {
        $maintenance = Maintenance::findOrFail($maintenanceId);
        $schedules = Schedule::join('vehicles', 'schedules.vehicle_id', '=', 'vehicles.id')
        ->join('vehicleoccupants', 'vehicles.id', '=', 'vehicleoccupants.vehicle_id')
        ->join('users', 'vehicleoccupants.user_id', '=', 'users.id')
        ->where('users.usertype_id', 2)
        ->where('schedules.maintenance_id', $maintenanceId)
        ->select('schedules.*', 'users.name as user_name', 'vehicles.name as vehicle_name')
        ->get();
        return view('admin.schedules.index', compact('schedules', 'maintenance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($maintenanceId)
    {
        $maintenance = Maintenance::findOrFail($maintenanceId);
        $vehicles = Vehicle::all();
        return view('admin.schedules.create', compact('maintenance', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $maintenanceId)
    {
        $request->validate([
            'day' => 'required',
            'type' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
        ]);

        $existingSchedules = Schedule::where('maintenance_id', $maintenanceId)
            ->where('day', $request->day)
            ->where('vehicle_id', $request->vehicle_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('time_start', '<', $request->time_end)
                          ->where('time_end', '>', $request->time_start);
                });
            })
            ->exists();

        if ($existingSchedules) {
            return redirect()->back()->with('error', 'El horario se cruza con otro existente para el mismo vehículo en el mismo día.');
        }

        $schedule = new Schedule($request->all());
        $schedule->maintenance_id = $maintenanceId;
        $schedule->save();

        return redirect()->route('admin.schedules.index', $maintenanceId)->with('success', 'Horario registrado');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($maintenanceId, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $maintenance = Maintenance::findOrFail($maintenanceId);
        $vehicles = Vehicle::all();
        return view('admin.schedules.edit', compact('schedule', 'maintenance', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $maintenanceId, $id)
    {
        $request->validate([
            'day' => 'required',
            'type' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
        ]);

        $existingSchedules = Schedule::where('maintenance_id', $maintenanceId)
            ->where('day', $request->day)
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('time_start', '<', $request->time_end)
                          ->where('time_end', '>', $request->time_start);
                });
            })
            ->where('id', '!=', $id)
            ->exists();

        if ($existingSchedules) {
            return redirect()->back()->withErrors(['error' => 'El horario se cruza con otro existente en el mismo día.']);
        }

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index', $maintenanceId)->with('success', 'Horario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($maintenanceId, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedules.index', $maintenanceId)->with('success', 'Horario eliminado');
    }
}
