<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status_resource_id'];

    protected $with = ['status_resource:id,name'];

    public function status_resource()
    {
        return $this->belongsTo(StatusResource::class);
    }
}
