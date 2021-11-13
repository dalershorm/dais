<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'address',
        'description',
        'status_id',
    ];

    protected $appends = [
        'sum_price',
    ];

    public const STATUS_RESOURCE_ID             = 5; // id источника

    public const STATUS_CREATED                 = 14; // Создан
    public const STATUS_WAY                     = 15; // В пути
    public const STATUS_DELIVERY                = 16; // Доставлен
    public const STATUS_PAID                    = 17; // Оплачен

    public function delivery_orders() {
        return $this->belongsToMany(Order::class, 'delivery_orders');
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function getSumPriceAttribute()
    {
        $orders = DB::table('delivery_orders')->where('delivery_id', $this->id)->pluck('order_id');
        $sum_cost = Order::whereIn('id', $orders)->sum('cost');
        $sum_cost_china = Order::whereIn('id', $orders)->sum('cost_china');
        return $sum_cost + $sum_cost_china;
    }
}
