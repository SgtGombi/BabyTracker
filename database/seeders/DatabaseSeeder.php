<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // User::factory(10)->create();

        User::factory()->create([
            //
        ]);
=======
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
>>>>>>> 0d1fb0096412caa75a66dbe6238e7c5e8782cbf3
    }
}
