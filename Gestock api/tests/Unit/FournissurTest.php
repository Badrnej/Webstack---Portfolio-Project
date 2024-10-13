<?php

namespace Tests\Unit;
use App\Models\User;
use App\Models\Fournissur;
use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\WithFaker;

class FournissurTest extends TestCase
{
    public function test_create_fournissur()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $faker = Faker::create();
        $email = $faker->unique()->safeEmail;
        $response = $this->postJson('/api/fournissur', [
            'nom' => 'Test Fournissur',
            'email' => $email,
            'phone' => $faker->unique()->phoneNumber,
            'address' => '123 Test Street',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => 'Fournissur created successfully'
        ]);
    }

    public function test_get_all_fournissurs()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Fournissur::factory()->count(3)->create();

        $response = $this->getJson('/api/fournissurs');

        $response->assertStatus(200);
    }


    public function test_get_single_fournissur()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fournissur = Fournissur::factory()->create();

        $response = $this->getJson("/api/fournissur/{$fournissur->id}");

        $response->assertStatus(200);

    }

    public function test_update_fournissur()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fournissur = Fournissur::factory()->create();

        $faker = Faker::create();
        $email = $faker->unique()->safeEmail;
        $response = $this->postJson("/api/fournissur/update/{$fournissur->id}", [
            'nom' => 'Updated Fournissur',
            'email' => $email,
            'address' => '321 Updated Street',
        ]);

        $response->assertStatus(200);
    }


    public function test_delete_fournissur()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fournissur = Fournissur::factory()->create();

        $response = $this->deleteJson("/api/fournissur/{$fournissur->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => 'Fournissur deleted successfully'
        ]);
    }
}
