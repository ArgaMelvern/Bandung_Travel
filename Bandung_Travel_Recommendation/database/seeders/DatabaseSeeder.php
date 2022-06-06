<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // $this->call([
        //   PlaceTypeSeeder::class,
        //   PlaceSeeder::class,
        // ]);
        // \App\Models\User::factory(10)->create();
        $this->call(PlaceTypeSeeder::class);
        $this->call(PlaceSeeder::class);
        $this->call(UserSeeder::class);
    }
}
