<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Module;

class DashboardController extends Controller
{
    public function index()
    {
        $modules = Module::all()->groupBy('type');

        return view('dashboard', [
            'modules' => $modules,
            'assemblyVehicles' => [], // or your real data
        ]);
    }
}
