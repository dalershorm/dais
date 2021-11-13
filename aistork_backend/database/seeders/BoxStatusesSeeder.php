<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('box_statuses')->insert([
            ['name' => 'Создано' ],
            ['name' => 'Отправлено' ],
            ['name' => 'Прием в Душанбе'],
            ['name' => 'Возврат']
        ]);
    }
}
