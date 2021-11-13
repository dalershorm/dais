<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Send;
use App\Models\Status;
use Illuminate\Database\Seeder;

class SendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $send = Send::create([
                'name' => 'Отправка №' . ($i + 1),
                'status_id' => random_int(12, 13),
                'employer_id' => random_int(1, 1),
            ]);

            $send->boxes()->sync([($i + 1)]);
        }
    }
}
