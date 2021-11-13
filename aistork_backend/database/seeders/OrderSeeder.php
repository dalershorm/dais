<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Order::create([
                'user_id' => random_int(37, 50),
                'employer_id' => random_int(1,1),
                'track_code' => $faker->unique()->ean8,
                'weight' => random_int(1000, 90000),
                'comment' => 'Lorem text',
                'cost' => random_int(1000, 90000),
                'cost_china' => random_int(1000, 90000),
                'shipping_id' => random_int(1, 2),
                'direction_id' => 1,
                'boxes' => 100,
                'status_id' => random_int(1, 7),
            ]);
        }
    }
}
