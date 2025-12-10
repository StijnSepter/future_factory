<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        // ----------------------------------------------------
        // CHASSIS Modules (type: 'chassis')
        // ----------------------------------------------------
        Module::create([
            'name' => 'Chassis Standaard Auto',
            'type' => 'chassis',
            'assembly_time_blocks' => 4,
            'cost' => 5000.00,
            'image_path' => 'chassis/auto.png',
            'properties' => [
                'wheels' => 4,
                'vehicle_type' => 'Personenauto',
                'dimensions_cm' => '450x180x150',
            ],
        ]);

        Module::create([
            'name' => 'Chassis Zwaar Vracht',
            'type' => 'chassis',
            'assembly_time_blocks' => 8,
            'cost' => 15000.00,
            'image_path' => 'chassis/vracht.png',
            'properties' => [
                'wheels' => 6,
                'vehicle_type' => 'Vrachtwagen',
                'dimensions_cm' => '1000x250x300',
            ],
        ]);

        Module::create([
            'name' => 'Chassis Scooter Twee Wiel',
            'type' => 'chassis',
            'assembly_time_blocks' => 1,
            'cost' => 800.00,
            'image_path' => 'chassis/scooter.png',
            'properties' => [
                'wheels' => 2,
                'vehicle_type' => 'Scooter',
                'dimensions_cm' => '180x70x120',
            ],
        ]);

        // ----------------------------------------------------
        // DRIVE Modules (type: 'drive')
        // ----------------------------------------------------
        Module::create([
            'name' => 'Aandrijving Waterstof 300pk',
            'type' => 'drive',
            'assembly_time_blocks' => 5,
            'cost' => 12000.00,
            'image_path' => 'drive/h2.png',
            'properties' => [
                'energy_type' => 'waterstof',
                'power_hp' => 300,
            ],
        ]);

        Module::create([
            'name' => 'Aandrijving Elektrisch 100pk',
            'type' => 'drive',
            'assembly_time_blocks' => 3,
            'cost' => 6000.00,
            'image_path' => 'drive/elek.png',
            'properties' => [
                'energy_type' => 'elektriciteit',
                'power_hp' => 100,
            ],
        ]);

        // ----------------------------------------------------
        // WHEELS Modules (type: 'wheels')
        // ----------------------------------------------------
        Module::create([
            'name' => 'Wielen Zomer 17inch',
            'type' => 'wheels',
            'assembly_time_blocks' => 2,
            'cost' => 1200.00,
            'image_path' => 'wheels/zomer.png',
            'properties' => [
                'tire_type' => 'zomer',
                'diameter_inch' => 17,
                'suitable_chassis' => ['Chassis Standaard Auto'],
            ],
        ]);

        Module::create([
            'name' => 'Wielen AllSeason 24inch',
            'type' => 'wheels',
            'assembly_time_blocks' => 3,
            'cost' => 3000.00,
            'image_path' => 'wheels/allseason.png',
            'properties' => [
                'tire_type' => 'allseason',
                'diameter_inch' => 24,
                'suitable_chassis' => ['Chassis Zwaar Vracht'],
            ],
        ]);

        // ----------------------------------------------------
        // STEERING Modules (type: 'steering')
        // ----------------------------------------------------
        Module::create([
            'name' => 'Stuur Rond Leer',
            'type' => 'steering',
            'assembly_time_blocks' => 1,
            'cost' => 400.00,
            'image_path' => 'steering/rond.png',
            'properties' => [
                'adjustments' => 'Geen',
                'shape' => 'rond',
            ],
        ]);

        // ----------------------------------------------------
        // SEATS Modules (type: 'seats')
        // ----------------------------------------------------
        Module::create([
            'name' => 'Stoelen 2x Leer Zwart',
            'type' => 'seats',
            'assembly_time_blocks' => 2,
            'cost' => 1500.00,
            'image_path' => 'seats/leer.png',
            'properties' => [
                'count' => 2,
                'upholstery' => 'leer',
            ],
        ]);
        
        Module::create([
            'name' => 'Zadel Scooter Zwart',
            'type' => 'seats',
            'assembly_time_blocks' => 0.5,
            'cost' => 200.00,
            'image_path' => 'seats/zadel.png',
            'properties' => [
                'count' => 1,
                'upholstery' => 'kunstleer',
            ],
        ]);
    }
}