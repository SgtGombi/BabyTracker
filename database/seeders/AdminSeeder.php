<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'email' => 'csimbi@admin.hu',
            'password' => bcrypt('jelszo'),
            'name' => 'Csimbi',
            'active' => 1,
            'level' => 1,
        ]);
        Admin::create([
            'email' => 'gombi@admin.hu',
            'password' => bcrypt('jelszo'),
            'name' => 'Gombi',
            'active' => 1,
            'level' => 1,
        ]);
    }
}
