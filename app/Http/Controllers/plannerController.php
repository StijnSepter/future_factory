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

        return view('dashboards.planner', compact('days', 'tasks'));
    }

    public function store(Request $request)
    {
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'planned_date' => 'required|date',
            'time_slot' => 'required|integer|min:1|max:4',
            'robot' => 'required|string|max:255',
        ]);

        $exists = Vehicle::where('planned_date', $request->planned_date)
            ->where('time_slot', $request->time_slot)
            ->where('robot', $request->robot)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'robot' => 'Deze robot is al ingepland op dit tijdstip.'
            ])->withInput();
        }

        return back();
    }

    public function addToAgenda(){
        $unplannedVehicles = Vehicle::whereNull('planned_date')->get();

        return view('planner.add_to_agenda', compact('unplannedVehicles'));
    }
}
