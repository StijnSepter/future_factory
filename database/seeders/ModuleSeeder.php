<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    
    public function run()
    {
        // CHASSIS
        Module::create([
            'name' => 'Chassis Basic 2W',
            'type' => 'chassis',
            'properties' => [
                'wheels' => 2,
                'vehicle_type' => 'bike',
                'dimensions' => ['l' => 180, 'b' => 60, 'h' => 110],
            ],
            'assembly_time_blocks' => 1,
            'cost' => 500,
            'image' => 'chassis1.jpg',
        ]);

        Module::create([
            'name' => 'Chassis Car XL',
            'type' => 'chassis',
            'properties' => [
                'wheels' => 4,
                'vehicle_type' => 'car',
                'dimensions' => ['l' => 400, 'b' => 180, 'h' => 150],
            ],
            'assembly_time_blocks' => 2,
            'cost' => 4000,
            'image' => 'chassis2.jpg',
        ]);

        // DRIVE
        Module::create([
            'name' => 'Electric Motor 100HP',
            'type' => 'drive',
            'properties' => [
                'type' => 'electric',
                'power' => 100,
            ],
            'assembly_time_blocks' => 1,
            'cost' => 8000,
            'image' => 'drive1.jpg',
        ]);

        Module::create([
            'name' => 'Hydrogen Engine 200HP',
            'type' => 'drive',
            'properties' => [
                'type' => 'hydrogen',
                'power' => 200,
            ],
            'assembly_time_blocks' => 2,
            'cost' => 20000,
            'image' => 'drive2.jpg',
        ]);

        // WHEELS
        Module::create([
            'name' => 'Wheels Small Set',
            'type' => 'wheels',
            'properties' => [
                'type' => 'summer',
                'diameter' => 14,
                'amount' => 2,
                'compatible_chassis' => ['Chassis Basic 2W'],
            ],
            'assembly_time_blocks' => 1,
            'cost' => 300,
            'image' => 'wheels1.jpg',
        ]);

        Module::create([
            'name' => 'Wheels Car Set',
            'type' => 'wheels',
            'properties' => [
                'type' => 'allseason',
                'diameter' => 18,
                'amount' => 4,
                'compatible_chassis' => ['Chassis Car XL'],
            ],
            'assembly_time_blocks' => 1,
            'cost' => 1200,
            'image' => 'wheels2.jpg',
        ]);

        // STEERING
        Module::create([
            'name' => 'Standard Steering',
            'type' => 'steering',
            'properties' => [
                'shape' => 'round',
                'special' => 'none',
            ],
            'assembly_time_blocks' => 1,
            'cost' => 200,
            'image' => 'steering1.jpg',
        ]);

        Module::create([
            'name' => 'Sport Steering',
            'type' => 'steering',
            'properties' => [
                'shape' => 'oval',
                'special' => 'leather',
            ],
            'assembly_time_blocks' => 1,
            'cost' => 400,
            'image' => 'steering2.jpg',
        ]);

        // SEATS
        Module::create([
            'name' => 'Basic Seat',
            'type' => 'seats',
            'properties' => [
                'amount' => 1,
                'material' => 'fabric',
            ],
            'assembly_time_blocks' => 1,
            'cost' => 100,
            'image' => 'seat1.jpg',
        ]);

        Module::create([
            'name' => 'Luxury Seats',
            'type' => 'seats',
            'properties' => [
                'amount' => 5,
                'material' => 'leather',
            ],
            'assembly_time_blocks' => 2,
            'cost' => 1500,
            'image' => 'seat2.jpg',
        ]);
    }
}