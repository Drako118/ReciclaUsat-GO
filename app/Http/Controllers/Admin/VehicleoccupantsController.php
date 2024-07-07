<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usertype;
use App\Models\Vehicle;
use App\Models\Vehicleoccupant;
use Illuminate\Http\Request;

class VehicleoccupantsController extends Controller
{
    public function index($vehicleId)
    {
        $occupants = Vehicleoccupant::select(
            'vehicleoccupants.id as id',
            'vehicleoccupants.status as status',
            'users.name as user_name',
            'users.lastname as user_lastname',
            'vehicles.name as vehicle_name',
            'usertypes.name as usertype_name'
        )
        ->join('users', 'vehicleoccupants.user_id', '=', 'users.id')
        ->join('vehicles', 'vehicleoccupants.vehicle_id', '=', 'vehicles.id')
        ->join('usertypes', 'vehicleoccupants.usertype_id', '=', 'usertypes.id')
        ->where('vehicleoccupants.vehicle_id', $vehicleId)
        ->get();
        $vehicle = Vehicle::findOrFail($vehicleId);
        return view('admin.vehicleoccupants.index', compact('occupants', 'vehicle'));
    }

    public function create($vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        $usertypes = Usertype::whereIn('id', [2, 3])->pluck('name', 'id');
        return view('admin.vehicleoccupants.create', compact('vehicle', 'usertypes'));
    }

    public function store(Request $request, $vehicleId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'usertype_id' => 'required|exists:usertypes,id',
            'status' => 'required|boolean',
        ]);

        $vehicle = Vehicle::findOrFail($vehicleId);
        $occupantsCount = Vehicleoccupant::where('vehicle_id', $vehicleId)->count();

        if ($occupantsCount >= $vehicle->capacity) {
            return redirect()->back()->with('error', 'La capacidad del vehículo ha sido alcanzada.');
        }

        $existingOccupant = Vehicleoccupant::where('vehicle_id', $vehicleId)
            ->where('usertype_id', $request->usertype_id)
            ->first();

        if ($request->usertype_id == 2 && $existingOccupant) {
            return redirect()->back()->with('error', 'Ya existe un conductor asignado a este vehículo.');
        }

        if ($request->usertype_id == 3) {
            $existingRecycler = Vehicleoccupant::where('vehicle_id', $vehicleId)
                ->where('user_id', $request->user_id)
                ->first();
            if ($existingRecycler) {
                return redirect()->back()->with('error', 'Este reciclador ya está asignado a este vehículo.');
            }
        }

        $userAssigned = Vehicleoccupant::where('user_id', $request->user_id)->first();
        if ($userAssigned) {
            return redirect()->back()->with('error', 'Este usuario ya está asignado a otro vehículo.');
        }

        $hasDriver = Vehicleoccupant::where('vehicle_id', $vehicleId)
            ->where('usertype_id', 2)
            ->exists();

        if (!$hasDriver && $request->usertype_id != 2) {
            return redirect()->back()->with('error', 'Debe asignar un conductor antes de asignar otros ocupantes.');
        }

        Vehicleoccupant::create([
            'vehicle_id' => $vehicleId,
            'user_id' => $request->user_id,
            'usertype_id' => $request->usertype_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.vehicleoccupants.index', $vehicleId)->with('success', 'Ocupante asignado correctamente');
    }

    public function destroy($id)
    {
        $occupant = Vehicleoccupant::findOrFail($id);
        $vehicleId = $occupant->vehicle_id;
        $occupant->delete();
        return redirect()->route('admin.vehicleoccupants.index', $vehicleId)->with('success', 'Ocupante eliminado correctamente');
    }

    public function usersByType($typeId)
    {
        $users = User::where('usertype_id', $typeId)->pluck('name', 'id');
        return response()->json($users);
    }
}
