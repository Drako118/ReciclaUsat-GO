<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usertype;
use Illuminate\Http\Request;

class UsertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usertypes = Usertype::all();
        return view('admin.usertypes.index', compact('usertypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Usertype::create($request->all());
        return redirect()->route('admin.usertypes.index')->with('success', 'Tipo de usuario registrado');
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
        $usertype = Usertype::find($id);
        return view('admin.usertypes.edit', compact('usertype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usertype = Usertype::find($id);
        $usertype->update($request->all());
        return redirect()->route('admin.usertypes.index')->with('success', 'Tipo de usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usertype = Usertype::find($id);
        $usertype->delete();
        return redirect()->route('admin.usertypes.index')->with('success', 'Tipo de usuario eliminado');
    }
}
