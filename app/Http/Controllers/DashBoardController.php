<?php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $data = [];

    // Check for Planner (Editor)
    if ($user->isPlanner()) {
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $days = collect();
        for ($i = 0; $i < 5; $i++) {
            $days->push($startOfWeek->copy()->addDays($i));
        }

        $data['days'] = $days;
        $data['tasks'] = \App\Models\Vehicle::whereNotNull('planned_date')->get();
    }

    // Check for Mechanic (Author)
    if ($user->isMechanic()) {
        $data['assemblyVehicles'] = \App\Models\Vehicle::where('status', 'assembly')->get();
        $data['modules'] = \App\Models\Module::all();
    }

    // // Check for Purchaser (Admin)
    // if ($user->isPurchaser()) {
    //     // Add purchaser specific data here
    // }

    return view('dashboard', $data);
}
}