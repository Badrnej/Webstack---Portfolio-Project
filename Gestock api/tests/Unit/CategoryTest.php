<?php

namespace Tests\Unit;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function store_category_authorized()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('gere les Categories');

        $response = $this->actingAs($user)->postJson('/api/categories', [
            'name' => 'New Category'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['name' => 'New Category']);
        $response->assertJson(['success' => 'Category created successfully']);
    }

    public function store_category_unauthorized()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/categories', [
            'name' => 'Unauthorized Category'
        ]);

        $response->assertStatus(500);
        $response->assertJson(['error' => 'Non autorisé']);
    }

    public function get_All_category(){
        $category = Category::factory()->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
        $response->assertJson($category->toArray());
    }

    public function get_category(){
        $category = Category::factory()->create();

        $response = $this->getJson('/api/categori/'.$category->id);

        $response->assertStatus(200);
        $response->assertJson($category->toArray());
    }

    public function test_update_a_category(){
        $user = User::factory()->create();
        $user->givePermissionTo('gere les Categories');
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/categori/update/' . $category->id, [
            'name' => 'Updated Categor'
        ]);

        $response->assertStatus(200);
    }

    public function test_update_a_category_unauthorized(){
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/categori/update/' . $category->id, [
            'name' => 'Updated Categor'
        ]);

        $response->assertStatus(500);
        $response->assertJson(['error' => 'Non autorisé']);
    }

    public function test_delete_category(){
        $user = User::factory()->create();
        $user->givePermissionTo('gere les Categories');
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/api/categori/' . $category->id);

        $response->assertStatus(200);
        $response->assertJson(['success' => 'Category deleted successfully']);
    }

    public function test_delete_category_unauthorized(){
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/api/categori/' . $category->id);

        $response->assertStatus(500);
        $response->assertJson(['error' => 'Non autorisé']);
    }
}
