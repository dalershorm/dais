<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            ['name' => 'Создано' ],
            ['name' => 'В ожидании' ],
            ['name' => 'Прием в Душанбе' ],
            ['name' => 'Оплаченные' ],
            ['name' => 'Остаток' ],
            ['name' => 'Возврат'],
            ['name' => 'В пути'] // Отправка
        ]);
    }
}
