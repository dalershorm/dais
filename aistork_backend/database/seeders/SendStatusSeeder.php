<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SendStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('send_statuses')->insert([
            ['name' => 'Создано'],
            ['name' => 'Прием в Душанбе'],
        ]);
    }
}
