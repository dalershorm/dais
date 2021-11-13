<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // personal users
        Permission::create([
            'name' => 'user-show',
            'display_name' => 'Показать клиента',
            'description' => 'Показать клиента',
        ]);

        Permission::create([
            'name' => 'user-create',
            'display_name' => 'Создать и редактировать клиента',
            'description' => 'Создать и редактировать клиента',
        ]);

        Permission::create([
            'name' => 'user-delete',
            'display_name' => 'Удалить клиента',
            'description' => 'Удалить клиента',
        ]);
        // employeer
        Permission::create([
            'name' => 'employeer-show',
            'display_name' => 'Показать сотрудника',
            'description' => 'Показать сотрудника',
        ]);

        Permission::create([
            'name' => 'employeer-create',
            'display_name' => 'Создать и редактировать сотрудника',
            'description' => 'Создать и редактировать сотрудника',
        ]);

        Permission::create([
            'name' => 'employeer-delete',
            'display_name' => 'Удалить сотрудника',
            'description' => 'Удалить сотрудника',
        ]);
        // order
        Permission::create([
            'name' => 'order-show',
            'display_name' => 'Показать прием заказа',
            'description' => 'Показать прием заказа',
        ]);

        Permission::create([
            'name' => 'order-create',
            'display_name' => 'Создать и редактировать прием заказа',
            'description' => 'Создать и редактировать прием заказа',
        ]);

        Permission::create([
            'name' => 'order-delete',
            'display_name' => 'Удалить прием заказа',
            'description' => 'Удалить прием заказа',
        ]);
        // box
        Permission::create([
            'name' => 'box-show',
            'display_name' => 'Показать клиента',
            'description' => 'Показать клиента',
        ]);

        Permission::create([
            'name' => 'box-create',
            'display_name' => 'Создать и редактировать клиента',
            'description' => 'Создать и редактировать клиента',
        ]);

        Permission::create([
            'name' => 'box-delete',
            'display_name' => 'Удалить клиента',
            'description' => 'Удалить клиента',
        ]);
        // send
        Permission::create([
            'name' => 'send-show',
            'display_name' => 'Показать отправка',
            'description' => 'Показать отправка',
        ]);

        Permission::create([
            'name' => 'send-create',
            'display_name' => 'Создать и редактировать отправка',
            'description' => 'Создать и редактировать отправка',
        ]);

        Permission::create([
            'name' => 'send-delete',
            'display_name' => 'Удалить отправка',
            'description' => 'Удалить отправка',
        ]);
        // reception dushanbe
        Permission::create([
            'name' => 'reception-dushanbe-show',
            'display_name' => 'Показать прием в Душанбе',
            'description' => 'Показать прием в Душанбе',
        ]);

        Permission::create([
            'name' => 'reception-dushanbe-create',
            'display_name' => 'Создать и редактировать прием в Душанбе',
            'description' => 'Создать и редактировать прием в Душанбе',
        ]);

        Permission::create([
            'name' => 'reception-dushanbe-delete',
            'display_name' => 'Удалить прием в Душанбе',
            'description' => 'Удалить прием в Душанбе',
        ]);
        // post
        Permission::create([
            'name' => 'post-show',
            'display_name' => 'Показать записи',
            'description' => 'Показать записи',
        ]);

        Permission::create([
            'name' => 'post-create',
            'display_name' => 'Создать и редактировать записи',
            'description' => 'Создать и редактировать записи',
        ]);

        Permission::create([
            'name' => 'post-delete',
            'display_name' => 'Удалить записи',
            'description' => 'Удалить записи',
        ]);
        // direction
        Permission::create([
            'name' => 'direction-show',
            'display_name' => 'Показать направление',
            'description' => 'Показать направление',
        ]);

        Permission::create([
            'name' => 'direction-create',
            'display_name' => 'Создать и редактировать направление',
            'description' => 'Создать и редактировать направление',
        ]);

        Permission::create([
            'name' => 'direction-delete',
            'display_name' => 'Удалить направление',
            'description' => 'Удалить направление',
        ]);
        // shipping
        Permission::create([
            'name' => 'shipping-show',
            'display_name' => 'Показать тип доставки',
            'description' => 'Показать тип доставки',
        ]);

        Permission::create([
            'name' => 'shipping-create',
            'display_name' => 'Создать и редактировать тип доставки',
            'description' => 'Создать и редактировать тип доставки',
        ]);

        Permission::create([
            'name' => 'shipping-delete',
            'display_name' => 'Удалить тип доставки',
            'description' => 'Удалить тип доставки',
        ]);
        // delivery 
        Permission::create([
            'name' => 'delivery-show',
            'display_name' => 'Доставки',
            'description' => 'Доставки',
        ]);
        // balance history
        Permission::create([
            'name' => 'balance-history-show',
            'display_name' => 'История баланса',
            'description' => 'История баланса',
        ]);
        // payment
        Permission::create([
            'name' => 'payment-show',
            'display_name' => 'Выдача',
            'description' => 'Выдача',
        ]);
        // cashbox-residue
        Permission::create([
            'name' => 'residue-show',
            'display_name' => 'Остаток',
            'description' => 'Остаток',
        ]);
        // cashbox-receipt
        Permission::create([
            'name' => 'receipt-show',
            'display_name' => 'Приход',
            'description' => 'Приход',
        ]);
        // cashbox-expense
        Permission::create([
            'name' => 'expense-show',
            'display_name' => 'Расход',
            'description' => 'Расход',
        ]);
        Permission::create([
            'name' => 'admin-show',
            'display_name' => 'Администратор сайта',
            'description' => 'Администратор сайта',
        ]);
        Permission::create([
            'name' => 'dashboard-show',
            'display_name' => 'Доступ в админ панель',
            'description' => 'Доступ в админ панель',
        ]);
        // main
        Permission::create([
            'name' => 'main-show',
            'display_name' => 'Главная страница',
            'description' => 'Главная страница',
        ]);
        // tasks
        Permission::create([
            'name' => 'task-show',
            'display_name' => 'Все задачи',
            'description' => 'Все задачи',
        ]);
    }
}
