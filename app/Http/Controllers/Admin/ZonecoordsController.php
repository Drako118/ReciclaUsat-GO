<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\Zonecoord;
use Illuminate\Http\Request;

class ZonecoordsController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Zonecoord::create($request->all());
        return redirect()->route('admin.zones.show', $request->zone_id)->with('success', 'Coodenada agregada');
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
        $zone = Zone::find($id);
        $lastCoord = Zonecoord::select('latitude as lat', 'longitude as lng')
            ->where('zone_id', $id)->latest()->first();

        $coords = Zonecoord::select('latitude as lat', 'longitude as lng')
            ->where('zone_id', $id)->get();

        return view('admin.zonecoords.create', compact('zone', 'lastCoord', 'coords'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
