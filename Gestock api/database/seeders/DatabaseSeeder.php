<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Fournissur;
use App\Models\Category;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create();
        Client::factory(10)->create();
        Fournissur::factory(10)->create();
        Category::factory(10)->create();

    }
}
