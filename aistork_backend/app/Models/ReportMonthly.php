<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMonthly extends Model
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

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function monthly_report_orders() {
        return $this->belongsToMany(Order::class, 'monthly_report_orders')->with('user');
    }
}
