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
        return view('dashboards.mechanic', compact('modules'));
    }

    public function store(Request $request)
    {
        // 1. Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'chassis_module_id' => 'required|exists:modules,id',
            'drive_module_id' => 'required|exists:modules,id',
            'wheels_module_id' => 'required|exists:modules,id',
            'steering_module_id' => 'required|exists:modules,id',
            'seats_module_id' => 'nullable|exists:modules,id',
        ]);

        // 2. Fetch ALL modules in ONE query (better 🔥)
        $moduleIds = collect($validated)
            ->filter(fn($value, $key) => str_contains($key, '_module_id') && $value)
            ->values();

        $modulesCollection = Module::whereIn('id', $moduleIds)->get()->keyBy('id');

        // 3. Map modules by type (clean structure)
        $modules = [
            'chassis' => $modulesCollection[$validated['chassis_module_id']],
            'drive' => $modulesCollection[$validated['drive_module_id']],
            'wheels' => $modulesCollection[$validated['wheels_module_id']],
            'steering' => $modulesCollection[$validated['steering_module_id']],
            'seats' => isset($validated['seats_module_id'])
                ? $modulesCollection[$validated['seats_module_id']]
                : null,
        ];

        // 4. Dependency check (your logic 👍 but cleaner)
        foreach ($modules as $type => $module) {
            if (!$module) continue;

            $dependencies = $module->properties['depends_on'] ?? [];

            foreach ($dependencies as $dependency) {
                if (empty($modules[$dependency])) {
                    return back()
                        ->withErrors([
                            "{$type}_module_id" => ucfirst($type) . " vereist eerst een {$dependency}"
                        ])
                        ->withInput();
                }
            }
        }

        // 5. Compatibility check (reuse modules ✅)
        $chassis = $modules['chassis'];
        $wheels = $modules['wheels'];

        if (!in_array($chassis->name, $wheels->properties['compatible_chassis'] ?? [])) {
            return back()
                ->withErrors([
                    'wheels_module_id' => 'Deze wielen zijn niet compatibel met het gekozen chassis'
                ])
                ->withInput();
        }

        // 6. Create vehicle
        $vehicle = Vehicle::create([
            'name' => $validated['name'],
            'chassis_module_id' => $validated['chassis_module_id'],
            'drive_module_id' => $validated['drive_module_id'],
            'wheels_module_id' => $validated['wheels_module_id'],
            'steering_module_id' => $validated['steering_module_id'],
            'seats_module_id' => $validated['seats_module_id'],
            'status' => 'in_assembly',
        ]);

        // 7. Redirect
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
