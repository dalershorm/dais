<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employer_id',
        'track_code',
        'weight',
        'comment',
        'cost',
        'cost_china',
        'shipping_id',
        'direction_id',
        'boxes',
        'status_id',
    ];

    protected $with = ['status:id,name'];

    public const STATUS_RESOURCE_ID             = 4; // id источника

    public const STATUS_RECEPTION_ORDER         = 1; // Прием заказа
    public const STATUS_PACKING                 = 2; // Упаковка
    public const STATUS_SEND                    = 3; // Отправка
    public const STATUS_RECEPTION_DUSHANBE      = 4; // Прием в Душанбе
    public const STATUS_RETURN                  = 5; // Возврат
    public const STATUS_REST                    = 6; // Остаток
    public const STATUS_PAY                     = 7; // Оплачен

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function direction() {
        return $this->belongsTo(Direction::class);
    }

    public function shipping() {
        return $this->belongsTo(Shipping::class);
    }

    public function balance_histories() {
        return $this->belongsToMany(User::class, 'balance_histories')->withPivot('cost_china');
    }
}
