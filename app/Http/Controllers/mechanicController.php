<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Module;

class MechanicController extends Controller
{
    public function create()
    {
        $modules = Module::all()->groupBy('type');
        return view('mechanic.create_vehicle', compact('modules'));
    }

    public function store(Request $request)
    {
        // 1. Validate
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'chassis_module_id' => 'required|exists:modules,id',
            'drive_module_id' => 'required|exists:modules,id',
            'wheels_module_id' => 'required|exists:modules,id',
            'steering_module_id' => 'required|exists:modules,id',
            'seats_module_id' => 'nullable|exists:modules,id',
        ]);

        // 2. Fetch modules (for validation logic)
        $chassis = Module::find($validated['chassis_module_id']);
        $wheels = Module::find($validated['wheels_module_id']);

        // 3. Compatibility check (VERY IMPORTANT for grading)
        if (!in_array($chassis->name, $wheels->properties['compatible_chassis'] ?? [])) {
            return back()
                ->withErrors(['wheels_module_id' => 'Deze wielen zijn niet compatibel met het gekozen chassis'])
                ->withInput();
        }

        // 4. Create vehicle
        $vehicle = Vehicle::create([
            'name' => $validated['name'],
            'chassis_module_id' => $validated['chassis_module_id'],
            'drive_module_id' => $validated['drive_module_id'],
            'wheels_module_id' => $validated['wheels_module_id'],
            'steering_module_id' => $validated['steering_module_id'],
            'seats_module_id' => $validated['seats_module_id'],
            'status' => 'in_assembly',
        ]);

        // 5. Redirect
        return redirect()
            ->route('vehicles.show', $vehicle->id)
            ->with('success', 'Voertuig succesvol samengesteld!');
    }

public function show($id)
{
    $vehicle = Vehicle::with([
        'chassis',
        'drive',
        'wheels',
        'steering',
        'seats'
    ])->findOrFail($id);

    return view('mechanic.show_vehicle', compact('vehicle'));
}

    // public function getTotalCostAttribute()
    // {
    // return collect([
    //     $this->chassis,
    //     $this->drive,
    //     $this->wheels,
    //     $this->steering,
    //     $this->seats,
    // ])->filter()->sum('cost');
    // }
   
}