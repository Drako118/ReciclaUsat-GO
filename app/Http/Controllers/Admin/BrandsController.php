<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->logo == "") {
            Brand::create($request->except('logo'));
        } else {
            $image = $request->file('logo')->store('public/brands_logo');
            $url = Storage::url($image);
            Brand::create([
                "name" => $request->name,
                "description" => $request->description,
                "logo" => $url
            ]);
        }
        return redirect()->route('admin.brands.index')->with('success', 'Marca registrada');
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
        $brand = Brand::find($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);

        if ($request->logo == "") {
            $brand->update($request->except('logo'));
        } else {
            $image = $request->file('logo')->store('public/brands_logo');
            $url = Storage::url($image);
            $brand->update([
                "name" => $request->name,
                "description" => $request->description,
                "logo" => $url
            ]);
        }

        return redirect()->route('admin.brands.index')->with('success', 'Marca actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Marca eliminada');
    }
}
