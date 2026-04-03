<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase; // Use this trait for a clean database
use App\Models\User;
use App\Models\Module;
use App\Models\Vehicle;

class PlannerControllerTest extends TestCase
{
    use RefreshDatabase;

    // A helper method to set up a Planner user and Modules
    protected function setUpPlannerAndModules()
    {
        // 1. Create a Planner user (assuming ROLE_EDITOR is your Planner role)
        $user = User::factory()->create([
            'role' => User::ROLE_EDITOR,
        ]);

        // 2. Create sample modules needed for the test
        // We use $this->seed(ModuleSeeder::class) if we were running a full seeder,
        // but for a clean unit test, we create minimal data directly.
        $modules = [];
        $modules['chassis'] = Module::create(['name' => 'Chassis A', 'type' => 'chassis', 'assembly_time_blocks' => 1, 'cost' => 1000, 'properties' => []]);
        $modules['drive']   = Module::create(['name' => 'Drive A', 'type' => 'drive', 'assembly_time_blocks' => 1, 'cost' => 1000, 'properties' => []]);
        $modules['wheels']  = Module::create(['name' => 'Wheels A', 'type' => 'wheels', 'assembly_time_blocks' => 1, 'cost' => 1000, 'properties' => []]);
        $modules['steering'] = Module::create(['name' => 'Steering A', 'type' => 'steering', 'assembly_time_blocks' => 1, 'cost' => 1000, 'properties' => []]);
        $modules['seats']   = Module::create(['name' => 'Seats A', 'type' => 'seats', 'assembly_time_blocks' => 1, 'cost' => 1000, 'properties' => []]);

        return [$user, $modules];
    }
    
    // -------------------------------------------------------------------------
    // TEST: create() method
    // -------------------------------------------------------------------------

    /** @test */
    public function planner_can_access_the_vehicle_creation_form()
    {
        // Arrange
        [$planner, $modules] = $this->setUpPlannerAndModules();

        // Act
        $response = $this->actingAs($planner)
            ->get(route('mechanic.create_vehicle'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('mechanic.create_vehicle');
    }

    /** @test */
    public function non_planner_cannot_access_the_vehicle_creation_form()
    {
        // Arrange
        $viewer = User::factory()->create(['role' => 'viewer']); // Assuming a viewer role exists

        // Act
        $response = $this->actingAs($viewer)
            ->get(route('mechanic.create_vehicle'));

        // Assert: Should be denied access (403 Forbidden)
        $response->assertStatus(403);
    }
    
    // -------------------------------------------------------------------------
    // TEST: store() method
    // -------------------------------------------------------------------------

    /** @test */
    public function planner_can_store_a_valid_vehicle_assembly_task()
    {
        // Arrange
        [$planner, $modules] = $this->setUpPlannerAndModules();
        $vehicleData = [
            'name' => 'Test Model X-4000',
            'chassis_module_id' => $modules['chassis']->id,
            'drive_module_id' => $modules['drive']->id,
            'wheels_module_id' => $modules['wheels']->id,
            'steering_module_id' => $modules['steering']->id,
            'seats_module_id' => $modules['seats']->id,
        ];

        // Act
        $response = $this->actingAs($planner)
            ->post(route('planner.store_vehicle'), $vehicleData);

        // Assert 1: Database Check
        $this->assertDatabaseHas('vehicles', [
            'name' => 'Test Model X-4000',
            'chassis_module_id' => $modules['chassis']->id,
            'status' => 'in_assembly', // Check the critical status field
        ]);

        // Assert 2: Redirection
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');

        // Assert 3: Ensure only one vehicle was created
        $this->assertEquals(1, Vehicle::count());
    }

    /** @test */
    public function store_fails_without_required_chassis_module()
    {
        // Arrange
        [$planner, $modules] = $this->setUpPlannerAndModules();
        $invalidData = [
            'name' => 'Test Model Y',
            // Missing 'chassis_module_id'
            'drive_module_id' => $modules['drive']->id,
            'wheels_module_id' => $modules['wheels']->id,
            'steering_module_id' => $modules['steering']->id,
        ];

        // Act
        $response = $this->actingAs($planner)
            ->post(route('planner.store_vehicle'), $invalidData);

        // Assert 1: Fails validation and returns back to the form
        $response->assertSessionHasErrors('chassis_module_id');

        // Assert 2: No vehicle was created in the database
        $this->assertEquals(0, Vehicle::count());
    }
}
