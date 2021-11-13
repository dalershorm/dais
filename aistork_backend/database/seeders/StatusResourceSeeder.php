<?php

namespace Database\Seeders;

use App\Models\StatusResource;
use Illuminate\Database\Seeder;

class StatusResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusResource::create([
            'name'=> 'Типы'
        ]);
        StatusResource::create([
            'name'=> 'Упаковка'
        ]);
        StatusResource::create([
            'name'=> 'Отправка'
        ]);
        StatusResource::create([
            'name'=> 'Заказы'
        ]);
        StatusResource::create([
            'name'=> 'Доставка'
        ]);
        StatusResource::create([
            'name'=> 'Прочее'
        ]);
    }
}
