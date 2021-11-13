<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Администратор сайта',
            'description' => 'Администратор сайта',
        ]);

        $moderator = Role::create([
            'name' => 'moderator',
            'display_name' => 'Модератор сайта',
            'description' => 'Модератор сайта',
        ]);

        $admin->permissions()->sync([1, 2]);
        echo $admin->id;
        User::find(1)->syncRoles([$admin->id]);
    }
}
