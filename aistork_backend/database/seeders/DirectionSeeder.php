<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directions')->insert([
            ['name' => 'Урумчи'],
            ['name' => 'Гуанджоу'],
            ['name' => 'Душанбе']
        ]);
    }
}
