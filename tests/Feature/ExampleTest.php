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

    /**
     * Test whatsapp url generation formats.
     */
    public function test_whatsapp_url_generation(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $bill = \App\Models\Bill::create([
            'date' => '2026-07-02',
            'bill_no' => 'B_123',
            'customer_name' => 'John Doe',
            'total' => 1500.50,
            'contact_number' => '9876543210',
        ]);

        $publicUrl = route('bill.public.preview', ['token' => $bill->secure_token]);
        $expectedText = "Hello John Doe, your invoice B_123 of Rs. 1500.5 is ready. View and download it here: {$publicUrl}";

        $this->assertEquals(
            'https://wa.me/919876543210?text=' . urlencode($expectedText),
            $bill->whatsapp_url
        );

        // Test with different prefixes
        $bill->contact_number = '+919876543210';
        $this->assertEquals(
            'https://wa.me/919876543210?text=' . urlencode($expectedText),
            $bill->whatsapp_url
        );

        $bill->contact_number = '919876543210';
        $this->assertEquals(
            'https://wa.me/919876543210?text=' . urlencode($expectedText),
            $bill->whatsapp_url
        );

        $bill->contact_number = '09876543210';
        $this->assertEquals(
            'https://wa.me/919876543210?text=' . urlencode($expectedText),
            $bill->whatsapp_url
        );

        $bill->contact_number = '';
        $this->assertEquals('#', $bill->whatsapp_url);
    }

    /**
     * Test guest access and secure token security constraints.
     */
    public function test_public_invoice_guest_access_and_security(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        // Create setting for company info
        \App\Models\Setting::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Corp',
        ]);

        $bill = \App\Models\Bill::create([
            'date' => '2026-07-02',
            'bill_no' => 'B_999',
            'customer_name' => 'Guest Customer',
            'total' => 2000.00,
            'contact_number' => '9876543210',
        ]);

        // Logout to simulate a guest customer opening the link
        $this->post('/logout');
        $this->assertGuest();

        // 1. Generate standard valid token URL
        $tokenUrl = route('bill.public.preview', ['token' => $bill->secure_token]);

        // 2. Guest can access the page with the valid token URL
        $response = $this->get($tokenUrl);
        $response->assertStatus(200);
        $response->assertSee('Guest Customer');
        $response->assertSee('Acme Corp');
        $response->assertSee('B_999');

        // 3. Guest cannot access with an invalid/tampered token (404)
        $invalidTokenUrl = route('bill.public.preview', ['token' => 'invalidtoken12345']);
        $responseInvalid = $this->get($invalidTokenUrl);
        $responseInvalid->assertStatus(404);

        // 4. Guest can download PDF using token-based download URL
        $downloadUrl = route('bill.public.download', ['token' => $bill->secure_token]);
        $responseDownload = $this->get($downloadUrl);
        $responseDownload->assertStatus(200);
        $responseDownload->assertHeader('Content-Type', 'application/pdf');
    }

    /**
     * Test global user scope tenant isolation and public route bypass.
     */
    public function test_global_user_scope_isolation_and_bypass(): void
    {
        $userA = \App\Models\User::create([
            'name' => 'User A',
            'email' => 'usera_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);

        $userB = \App\Models\User::create([
            'name' => 'User B',
            'email' => 'userb_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create product for User A
        $this->actingAs($userA);
        $productA = \App\Models\Product::create([
            'name' => 'Product A',
            'price' => 100.00,
            'tax' => 18,
            'description' => 'User A Product',
        ]);
        $billA = \App\Models\Bill::create([
            'date' => '2026-07-02',
            'bill_no' => 'A_111',
            'customer_name' => 'Customer A',
            'total' => 100.00,
        ]);

        // Switch to User B - should not see User A's products or bills
        $this->actingAs($userB);
        $this->assertEquals(0, \App\Models\Product::count());
        $this->assertEquals(0, \App\Models\Bill::count());

        // Create product/bill for User B
        $productB = \App\Models\Product::create([
            'name' => 'Product B',
            'price' => 200.00,
            'tax' => 12,
            'description' => 'User B Product',
        ]);
        $this->assertEquals(1, \App\Models\Product::count());
        $this->assertEquals('Product B', \App\Models\Product::first()->name);

        // Switch back to User A - should only see User A's items
        $this->actingAs($userA);
        $this->assertEquals(1, \App\Models\Product::count());
        $this->assertEquals('Product A', \App\Models\Product::first()->name);

        // Switch to User B and check if they can access User A's public invoice (bypass scope on public routes)
        $this->actingAs($userB);
        $tokenUrl = route('bill.public.preview', ['token' => $billA->secure_token]);
        $response = $this->get($tokenUrl);
        $response->assertStatus(200);
        $response->assertSee('Customer A');
    }
}
