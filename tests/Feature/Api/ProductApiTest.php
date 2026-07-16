<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an unauthenticated API request is rejected.
     */
    public function test_unauthenticated_request_returns_unauthorized(): void
    {
        $response = $this->postJson(route('api.products.store'), [
            'name' => 'Test Product',
            'price' => 99.99,
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test validation rules for product creation.
     */
    public function test_product_creation_validation_fails(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);

        // 1. Missing name & price
        $response = $this->actingAs($user)
            ->postJson(route('api.products.store'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'price']);

        // 2. Name too short, price not numeric
        $response = $this->actingAs($user)
            ->postJson(route('api.products.store'), [
                'name' => 'ab',
                'price' => 'not-numeric',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'price'])
            ->assertJsonFragment(['Product name must be at least 3 characters long.'])
            ->assertJsonFragment(['Price must be a number.']);

        // 3. Tax not in predefined rates
        $response = $this->actingAs($user)
            ->postJson(route('api.products.store'), [
                'name' => 'Valid Name',
                'price' => 100,
                'tax' => 15,
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['tax'])
            ->assertJsonFragment(['Tax rate must be one of the predefined rates.']);
    }

    /**
     * Test successful product creation.
     */
    public function test_product_created_successfully(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
        ]);

        $productData = [
            'name' => 'New Awesome Product',
            'price' => 199.99,
            'tax' => 18,
            'description' => 'A great description for the product.',
        ];

        $response = $this->actingAs($user)
            ->postJson(route('api.products.store'), $productData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'price',
                    'tax',
                    'description',
                    'user_id',
                    'created_at',
                    'updated_at',
                ]
            ])
            ->assertJson([
                'success' => true,
                'message' => 'Product created successfully.',
                'data' => [
                    'name' => 'New Awesome Product',
                    'price' => 199.99,
                    'tax' => 18,
                    'description' => 'A great description for the product.',
                    'user_id' => $user->id,
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'name' => 'New Awesome Product',
            'price' => 199.99,
            'tax' => 18,
            'description' => 'A great description for the product.',
            'user_id' => $user->id,
        ]);
    }
}
