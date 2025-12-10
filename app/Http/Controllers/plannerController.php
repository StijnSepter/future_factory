<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Vehicle;

class PlannerController extends Controller
{
    // Shows the form with module options
    public function create()
    {
        // Fetch all modules grouped by their type for easy form population
        $modules = Module::all()->groupBy('type');
        
        return view('planner.create_vehicle', compact('modules'));
    }

    // Stores the new vehicle/task in the database
    public function store(Request $request)
    {
        // 1. Validate Input (Ensure all required module IDs exist)
        $request->validate([
            'name' => 'required|string|max:255',
            'chassis_module_id' => 'required|exists:modules,id',
            'drive_module_id' => 'required|exists:modules,id',
            'wheels_module_id' => 'required|exists:modules,id',
            'steering_module_id' => 'required|exists:modules,id',
            'seats_module_id' => 'nullable|exists:modules,id',
        ]);
        
        // 2. Create the new Vehicle (The assembly task)
        Vehicle::create([
            'name' => $request->name,
            'chassis_module_id' => $request->chassis_module_id,
            'drive_module_id' => $request->drive_module_id,
            'wheels_module_id' => $request->wheels_module_id,
            'steering_module_id' => $request->steering_module_id,
            'seats_module_id' => $request->seats_module_id,
            'status' => 'in_assembly', // Automatically mark as ready for mechanic
        ]);
        
        // 3. Redirect back to the Planner dashboard
        return redirect()->route('dashboard')->with('success', 'Nieuwe productietaak is succesvol aangemaakt en naar de assemblage gestuurd.');
    }
}