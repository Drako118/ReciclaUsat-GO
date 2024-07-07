<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Vehicleimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleImagesController extends Controller
{
    public function index($vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        $images = Vehicleimage::where('vehicle_id', $vehicleId)->orderBy('id', 'desc')->get();
        return view('admin.vehicleimages.index', compact('vehicle', 'images'));
    }

    public function create($vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        return view('admin.vehicleimages.create', compact('vehicle'));
    }

    public function store(Request $request, $vehicleId)
    {
        if ($request->file('image') == "") {
            VehicleImage::create($request->except('image'));
        } else {
            $image = $request->file('image')->store('public/vehicle_images');
            $url = Storage::url($image);

            // Si el perfil es verdadero, establece todos los demás perfiles de este vehículo a falso
            if ($request->profile) {
                VehicleImage::where('vehicle_id', $vehicleId)->update(['profile' => false]);
            }

            VehicleImage::create([
                "vehicle_id" => $vehicleId,
                "image" => $url,
                "profile" => $request->profile ? true : false
            ]);
        }
        return redirect()->route('admin.vehicleimages.index', $vehicleId)->with('success', 'Imagen agregada');
    }

    public function destroy(string $id)
    {
        $vehicle = Vehicleimage::find($id);
        $vehicle->delete();
        return redirect()->route('admin.vehicleimages.index', $vehicle->vehicle_id)->with('success', 'Imagen eliminada');
    }
}
