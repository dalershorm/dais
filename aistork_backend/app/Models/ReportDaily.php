<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDaily extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost',
        'weight',
        'total',
        'status_id',
        'report_date'
    ];

    protected $casts = [
        'cost'   => 'float',
        'weight' => 'float',
    ];

    public const STATUS_RESOURCE_ID             = 6; // id источника

    public const STATUS_CREATED                 = 18; // Создан
    public const STATUS_CLOSED                  = 19; // Закрыт

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function daily_report_orders() {
        return $this->belongsToMany(Order::class, 'daily_report_orders')->with('user');
    }
}
