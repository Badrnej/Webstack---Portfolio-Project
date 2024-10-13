<?php

namespace Tests\Unit;

use App\Http\Controllers\AuthController;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;
use Faker\Factory as Faker;
use Mockery;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    // test register start
    public function test_register_successfully()
    {
        $faker = Faker::create();
        $email = $faker->unique()->safeEmail;
        $response = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertJsonStructure(['user', 'token']);
    }

    public function test_register_invalid_data(){
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'pass',
            'password_confirmation' => 'different-pass',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    // test register end

    // test login start
    public function test_login_successfully()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);
    
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => ['id', 'name', 'email'],
            'token',
            'role'
        ]);
    }

    public function test_login_invalid(){
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);
    
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
    
        $response->assertStatus(401);
        $response->assertJson(['message' => 'Invalid credentials']);
    }

    // test login end

    // test logout start
    public function test_logout()
    {
        $user = User::factory()->create();

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Successfully logged out'
                 ]);
    }
    // test logout end
}