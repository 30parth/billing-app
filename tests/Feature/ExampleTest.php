<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test that user creation automatically creates a BillSeries record.
     */
    public function test_user_creation_creates_bill_series(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->assertDatabaseHas('bill_series', [
            'user_id' => $user->id,
            'prefix' => 'B_',
            'current' => 0,
        ]);
    }
}
