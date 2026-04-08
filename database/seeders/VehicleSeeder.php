<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\Module;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch necessary module IDs
        $chassisCar = Module::where('name', 'Chassis Car XL')->firstOrFail()->id;
        $chassisScooter = Module::where('name', 'Chassis Basic 2W')->firstOrFail()->id;
        $driveH2 = Module::where('name', 'Hydrogen Engine 200HP')->firstOrFail()->id;
        $driveElek = Module::where('name', 'Electric Motor 100HP')->firstOrFail()->id;
        $wheelsZomer = Module::where('name', 'Wheels Car Set')->firstOrFail()->id;
        $wheelsAllSeason = Module::where('name', 'Wheels Small Set')->firstOrFail()->id;
        $steeringRond = Module::where('name', 'Standard Steering')->firstOrFail()->id;
        $seatsCar = Module::where('name', 'Luxury Seats')->firstOrFail()->id;
        $seatsScooter = Module::where('name', 'Basic Seat')->firstOrFail()->id;

        // ----------------------------------------------------
        // Vehicle 1: Hydrogen Car (In Assembly)
        // ----------------------------------------------------
        Vehicle::create([
            'name' => 'Future Car H-300',
            'status' => 'in_assembly',
            'robot' => 'hydroboy', // ✅ add this
            'chassis_module_id' => $chassisCar,
            'drive_module_id' => $driveH2,
            'wheels_module_id' => $wheelsZomer,
            'steering_module_id' => $steeringRond,
            'seats_module_id' => $seatsCar,
        ]);

        // ----------------------------------------------------
        // Vehicle 2: Electric Scooter (Completed)
        // ----------------------------------------------------
        Vehicle::create([
            'name' => 'City Scooter E-100',
            'status' => 'completed',
            'robot' => 'twoWheels', // ✅
            'chassis_module_id' => $chassisScooter,
            'drive_module_id' => $driveElek,
            'wheels_module_id' => $wheelsAllSeason,
            'steering_module_id' => $steeringRond,
            'seats_module_id' => $seatsScooter,
        ]);
    }
}
