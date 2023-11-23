<?php

namespace Database\Seeders;

use App\Models\{Task, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Ibrahim Ali',
             'email' => 'admin@admin.com',
         ]);

        Task::factory(10)->create();
    }
}
