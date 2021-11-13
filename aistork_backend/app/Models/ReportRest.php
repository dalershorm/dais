<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportRest extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost',
        'weight',
        'total',
        'status_id',
        'report_date',
        'type'
    ];

    protected $casts = [
        'cost'   => 'float',
        'weight' => 'float',
    ];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function report_rest_order_dailies() {
        return $this->belongsToMany(Order::class, 'report_rest_order_dailies');
    }

    public function report_rest_order_monthlies() {
        return $this->belongsToMany(Order::class, 'report_rest_order_monthlies');
    }
}
