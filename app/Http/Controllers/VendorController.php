<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Location;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::with('location')->get();

        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        $locations = Location::all();

        return view('vendors.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
        ]);

        Vendor::create($request->only([
            'vendor_name',
            'location_id'
        ]));

        return redirect()->route('vendors.index')
                         ->with('success', 'Vendor added successfully!');
    }

    public function edit(Vendor $vendor)
    {
        $locations = Location::all();

        return view('vendors.edit', compact('vendor', 'locations'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'vendor_name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
        ]);

        $vendor->update($request->only([
            'vendor_name',
            'location_id'
        ]));

        return redirect()->route('vendors.index')
                         ->with('success', 'Vendor updated successfully!');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendors.index')
                         ->with('success', 'Vendor deleted successfully!');
    }
}
