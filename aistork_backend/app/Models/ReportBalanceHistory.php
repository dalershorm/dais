<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportBalanceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'type'
    ];

    protected $casts = [
        'price' => 'float'
    ];
}
