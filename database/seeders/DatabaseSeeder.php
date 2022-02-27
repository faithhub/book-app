<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            BookMaterialSeeder::class,
            // AdminSeeder::class,
            // BookCategorySeeder::class,
            // CountrySeeder::class,
            // SubscriptionSeeder::class
        ]);
    }
}
