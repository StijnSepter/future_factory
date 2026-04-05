<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Vehicle;
use Carbon\Carbon;

class PlannerController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();

        $days = collect();
        for ($i = 0; $i < 5; $i++) {
            $days->push($startOfWeek->copy()->addDays($i));
        }

        $tasks = Vehicle::whereNotNull('planned_date')->get();
        return view('dashboard', compact('days', 'tasks'));
    }

    public function store(Request $request)
    {
        // 1. Validate input
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'planned_date' => 'required|date',
            'time_slot' => 'required|integer|min:1|max:4',
            'robot' => 'required|in:hydroboy,heavyD,twoWheels',
        ]);

        // 2. Check if this robot already has a task at that time
        $exists = Vehicle::where('planned_date', $validated['planned_date'])
            ->where('time_slot', $validated['time_slot'])
            ->where('robot', $validated['robot'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'robot' => 'Deze robot is al ingepland op dit tijdstip.'
            ])->withInput();
        }

        // 3. Save the plan to the vehicle
        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);
        $vehicle->planned_date = $validated['planned_date'];
        $vehicle->time_slot = $validated['time_slot'];
        $vehicle->robot = $validated['robot'];
        $vehicle->save();

        // 4. Redirect back to the planner calendar
        return redirect()->route('planner.index')
            ->with('success', 'Voertuig succesvol ingepland!');
    }

    public function addToAgenda()
    {
        $unplannedVehicles = Vehicle::whereNull('planned_date')->get();
        $robots = ['hydroboy', 'heavyD', 'twoWheels'];

        return view('planner.add_to_agenda', compact('unplannedVehicles', "robots"));
    }
}
