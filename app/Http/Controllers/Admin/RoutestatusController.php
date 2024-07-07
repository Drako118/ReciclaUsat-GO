<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routestatus;
use Illuminate\Http\Request;

class RoutestatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routestatuses = Routestatus::all();
        return view('admin.routestatuses.index', compact('routestatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.routestatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Routestatus::create($request->all());
        return redirect()->route('admin.routestatuses.index')->with('success', 'Estado de ruta registrado');
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
        $routestatus = Routestatus::find($id);
        return view('admin.routestatuses.edit', compact('routestatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $routestatus = Routestatus::find($id);
        $routestatus->update($request->all());
        return redirect()->route('admin.routestatuses.index')->with('success', 'Estado de ruta actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $routestatus = Routestatus::find($id);
        $routestatus->delete();
        return redirect()->route('admin.routestatuses.index')->with('success', 'Estado de ruta eliminado');
    }
}
