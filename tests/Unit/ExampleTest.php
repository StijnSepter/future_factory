<?php

use App\Models\User; // Need to import User

test('the application redirects logged-in users to the dashboard', function () {
    // 1. Create a minimal user
    $user = User::factory()->create();

    // 2. Act as the user and visit the root path
    $response = $this->actingAs($user)->get('/');

    // 3. Assert redirection to the dashboard route
    $response->assertRedirect(route('dashboard'));
});