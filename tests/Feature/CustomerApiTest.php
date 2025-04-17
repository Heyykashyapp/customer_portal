<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CustomerApiTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_create_customer_validation()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password')
        ]);

        $response = $this->actingAs($user, 'api')->postJson('/api/customers', []);
        $response->assertStatus(422); 
        $response->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'dob', 'age']);
    }

    
    public function test_create_customer_success()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password')
        ]);

        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'dob' => '1990-01-01',
            'age' => 31
        ];

        $response = $this->actingAs($user, 'api')->postJson('/api/customers', $data);
        $response->assertStatus(201); 
        $response->assertJson(fn (AssertableJson $json) =>
    $json->where('first_name', 'John')
         ->where('last_name', 'Doe')
         ->where('email', 'johndoe@example.com')
         ->etc()

    );
    }

    
    public function test_get_customers_list()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password')
        ]);

        Customer::factory()->create(['first_name' => 'John', 'last_name' => 'Doe']);

        $response = $this->actingAs($user, 'api')->getJson('/api/customers');
        $response->assertStatus(200); 
        $response->assertJsonCount(1); 
    }

   
    public function test_update_customer()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password')
        ]);

        $customer = Customer::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'dob' => '1990-01-01',
            'age' => 31
        ]);

        $data = [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'janesmith@example.com',
            'dob' => '1992-02-02',
            'age' => 29
        ];

        $response = $this->actingAs($user, 'api')->putJson("/api/customers/{$customer->id}", $data);
        $response->assertStatus(200); 
        $response->assertJson(fn (AssertableJson $json) =>
        $json->where('first_name', 'Jane')
             ->where('last_name', 'Smith')
             ->where('email', 'janesmith@example.com')
             ->etc()
    );
    
    
    }

    
    public function test_delete_customer()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password')
        ]);

        $customer = Customer::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'dob' => '1990-01-01',
            'age' => 31
        ]);

        $response = $this->actingAs($user, 'api')->deleteJson("/api/customers/{$customer->id}");
        $response->assertStatus(200); 
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]); 
    }
}
