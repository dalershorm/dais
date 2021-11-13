<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class BoxSeeder extends Seeder
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
            $box = Box::create([
                'name' => "BX".$faker->unique()->ean8,
                'status_id' => random_int(8, 11),
                'employer_id' => random_int(1, 1),
            ]);

            $box->orders()->sync([($i + 1)]);
        }
    }
}
