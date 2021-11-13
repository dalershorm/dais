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
            DirectionSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            StatusResourceSeeder::class,
            StatusSeeder::class,
            PostSeeder::class,
            OrderSeeder::class,
            ShippingSeeder::class,
            BoxSeeder::class,
            SendSeeder::class
        ]);
    }
}
