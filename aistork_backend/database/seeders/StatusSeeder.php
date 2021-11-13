<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Прием заказа',
            'status_resource_id' => 4,
        ]);
        Status::create([
            'name' => 'Упаковка',
            'status_resource_id' => 4,
        ]);
        Status::create([
            'name' => 'Отправка',
            'status_resource_id' => 4,
        ]);
        Status::create([
            'name' => 'Прием в Душанбе',
            'status_resource_id' => 4,
        ]);
        Status::create([
            'name' => 'Возврат',
            'status_resource_id' => 4,
        ]);
        Status::create([
            'name' => 'Остаток',
            'status_resource_id' => 4,
        ]);
        Status::create([
            'name' => 'Оплачен',
            'status_resource_id' => 4,
        ]);

        Status::create([
            'name' => 'Создан',
            'status_resource_id' => 2,
        ]);
        Status::create([
            'name' => 'Отправка',
            'status_resource_id' => 2,
        ]);
        Status::create([
            'name' => 'Прием в Душанбе',
            'status_resource_id' => 2,
        ]);
        Status::create([
            'name' => 'Возврат',
            'status_resource_id' => 2,
        ]);

        Status::create([
            'name' => 'Создано',
            'status_resource_id' => 3,
        ]);
        Status::create([
            'name' => 'Прием в Душанбе',
            'status_resource_id' => 3,
        ]);

        Status::create([
            'name' => 'Создано',
            'status_resource_id' => 5,
        ]);
        // Status::create([
        //     'name' => 'В ожидании',
        //     'status_resource_id' => 5,
        // ]);
        Status::create([
            'name' => 'В пути',
            'status_resource_id' => 5,
        ]);
        Status::create([
            'name' => 'Доставлен',
            'status_resource_id' => 5,
        ]);
        Status::create([
            'name' => 'Оплачен',
            'status_resource_id' => 5,
        ]);


        Status::create([
            'name' => 'Создан',
            'status_resource_id' => 6,
        ]);
        Status::create([
            'name' => 'Закрыт',
            'status_resource_id' => 6,
        ]);

    }
}
