<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight',
        'places',
        'total',
        'cost',
        'cost_china',
        'employer_id',   
    ];

    public function payment_orders()
    {
        return $this->belongsToMany(Order::class, 'payment_orders')->with('user');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function employer() {
        return $this->belongsTo(User::class);
    }
}
