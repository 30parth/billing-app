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

    /**
     * Test validation rules for Indian contact numbers.
     */
    public function test_contact_number_validation(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);

        // Valid Indian numbers
        $validNumbers = ['9876543210', '+919876543210', '919876543210', '09876543210', '7890123456', '8901234567', '6789012345'];
        foreach ($validNumbers as $number) {
            \Livewire\Livewire::actingAs($user)
                ->test(\App\Livewire\Bill\BillForm::class)
                ->set('form.contact_number', $number)
                ->call('save')
                ->assertHasNoErrors(['form.contact_number']);
        }

        // Invalid numbers
        $invalidNumbers = ['1234567890', '5876543210', '987654321', '98765432100', 'abcdefghij', '+911234567890'];
        foreach ($invalidNumbers as $number) {
            \Livewire\Livewire::actingAs($user)
                ->test(\App\Livewire\Bill\BillForm::class)
                ->set('form.contact_number', $number)
                ->call('save')
                ->assertHasErrors(['form.contact_number']);
        }
    }
}
