<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() 
{
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $data = [];

    if ($user && $user->isPlanner()) {
        // Use the request() helper instead of the $request variable
        $viewType = request()->query('view', 'week');

        $daysToShow = match($viewType) {
            'day' => 1,
            'month' => 30,
            default => 7, 
        };

        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $days = collect();
        
        for ($i = 0; $i < $daysToShow; $i++) {
            $days->push($startOfWeek->copy()->addDays($i));
        }

        $data['days'] = $days;
        $data['tasks'] = \App\Models\Vehicle::whereNotNull('planned_date')->get();
        $data['currentView'] = $viewType;
    }

        // Check for Mechanic (Author)
    if ($user->isMechanic()) {
        $data['modules'] = \App\Models\Module::all()->groupBy('type');
        $data['assemblyVehicles'] = \App\Models\Vehicle::all(); 
    }

        return view('dashboard', $data);
    }
}
