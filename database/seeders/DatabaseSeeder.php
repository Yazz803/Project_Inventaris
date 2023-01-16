<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(50)->create();
        // \App\Models\Category::factory(50)->create();

        \App\Models\User::factory()->create([
            'name' => 'Muhammad Yazid Akbar',
            'email' => 'yazzhanz@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Sutaro Putra Pratama',
            'email' => 'sutaro@gmail.com',
            'role' => 'operator',
            'password' => bcrypt('password'),
        ]);

        Category::create([
            'name' => 'Alat Dapur',
            'division_pj' => 'Sarpas',
        ]);

        Item::create([
            'name' => 'Piring',
            'category_id' => 1,
            'edited_by' => 'Operator Wikrama',
            'total' => 10,
            'peminjam' => 'Ka David',
        ]);
    }
}
