<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Send extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status_id',
        'employer_id',
        'comment'
    ];
    
    protected $appends = [
        'info',
    ];

    protected $with = ['status:id,name'];

    public const STATUS_RESOURCE_ID             = 3; // id источника

    public const STATUS_CREATED                 = 12; // Создан
    public const STATUS_RECEPTION_DUSHANBE      = 13; // Прием в Душанбе

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function boxes()
    {
        return $this->belongsToMany(Box::class, 'send_boxes');
    }

    public function getInfoAttribute()
    {
        $orders = BoxOrder::where('box_id', $this->id)->pluck('id');
        $data = (object)[];
        $data->cost = Order::whereIn('id', $orders)->sum('cost');
        $data->cost_china = Order::whereIn('id', $orders)->sum('cost_china');
        $data->weight = Order::whereIn('id', $orders)->sum('weight');
        $data->boxes = Order::whereIn('id', $orders)->sum('boxes');
        $data->box_totals = count($this->boxes);
        return $data;
    }
}
