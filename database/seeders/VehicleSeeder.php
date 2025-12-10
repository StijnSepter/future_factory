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
        $chassisCar = Module::where('name', 'Chassis Standaard Auto')->first()->id;
        $chassisScooter = Module::where('name', 'Chassis Scooter Twee Wiel')->first()->id;
        $driveH2 = Module::where('name', 'Aandrijving Waterstof 300pk')->first()->id;
        $driveElek = Module::where('name', 'Aandrijving Elektrisch 100pk')->first()->id;
        $wheelsZomer = Module::where('name', 'Wielen Zomer 17inch')->first()->id;
        $wheelsAllSeason = Module::where('name', 'Wielen AllSeason 24inch')->first()->id;
        $steeringRond = Module::where('name', 'Stuur Rond Leer')->first()->id;
        $seatsCar = Module::where('name', 'Stoelen 2x Leer Zwart')->first()->id;
        $seatsScooter = Module::where('name', 'Zadel Scooter Zwart')->first()->id;

        // ----------------------------------------------------
        // Vehicle 1: Hydrogen Car (In Assembly)
        // ----------------------------------------------------
        Vehicle::create([
            'name' => 'Future Car H-300',
            'status' => 'in_assembly',
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
            'chassis_module_id' => $chassisScooter,
            'drive_module_id' => $driveElek,
            'wheels_module_id' => $wheelsZomer, // Reusing wheels for simplicity
            'steering_module_id' => $steeringRond, // Reusing steering for simplicity
            'seats_module_id' => $seatsScooter,
        ]);
    }
}