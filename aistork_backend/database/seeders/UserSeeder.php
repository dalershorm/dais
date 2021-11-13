<?php

namespace Database\Seeders;

use App\Models\Builder;
use App\Models\SalesOffice;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'         => 'Daler',
            'phone'        => '985191595',
            'is_active'    => 1,
            'password'     => 'password',
            'avatar'       => 'https://via.placeholder.com/992x768',
            'direction_id' => 1,
            'employer'    => 1,
            'balance'      => 1000,
            'client_code'  => 'D-34325'
        ]);

        for ($i = 0; $i < 50; $i++) {
            $user = User::create([
                'name'      => Str::random(10),
                'phone'     => random_int(985100000, 985999999),
                'is_active'    => 1,
                'password'     => 'password',
                'avatar'       => 'https://via.placeholder.com/992x768',
                'direction_id' => random_int(1, 3),
                'employer'    => $i < 35 ? 1 : 0,
            ]);
            if ($i >= 35) {
                $user->client_code = str_split($user->name)[0] . '-' . $user->id . random_int(1000, 9999);
                $user->save();
            }
        }
    }
}
