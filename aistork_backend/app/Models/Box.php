<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status_id',
        'employer_id'
    ];

    protected $appends = [
        'weight'
    ];
    protected $with = ['status:id,name'];

    public const STATUS_RESOURCE_ID             = 2; // id источника

    public const STATUS_CREATED                 = 8; // Создан
    public const STATUS_SEND                    = 9; // Отправка
    public const STATUS_RECEPTION_DUSHANBE      = 10; // Прием в Душанбе
    public const STATUS_RETURN                  = 11; // Возврат

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'box_orders');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function getWeightAttribute() {
        $weight = 0;
        foreach ($this->orders as $order) {
            $weight += $order->weight;
        }
        return $weight;
    }
}
