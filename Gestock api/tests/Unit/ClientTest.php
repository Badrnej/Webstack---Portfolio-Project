<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Faker\Factory as Faker;
class ClientTest extends TestCase
{

    public function test_get_All_Client(){
        $user = User::factory()->create();
        $this->actingAs($user);
        Client::factory()->count(10)->create();

        $response = $this->getJson('/api/clients');

        $response->assertStatus(200);
    }

    public function test_get_Client(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $Client=Client::factory()->create();

        $response = $this->getJson('/api/client/'.$Client->id);

        $response->assertStatus(200);
    }

    public function test_update_Client(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $client = Client::factory()->create();

        $faker = Faker::create();
        $email = $faker->unique()->safeEmail;
        $updateData = [
            'name' => 'Jane Doe',
            'email' => $email,
        ];

        $response = $this->postJson("/api/client/update/{$client->id}", $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('clients', $updateData);
}

     public function test_delete_Client(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $client = Client::factory()->create();

        $response = $this->deleteJson("/api/client/{$client->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
     }
}