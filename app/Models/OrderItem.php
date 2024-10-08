<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'certification_id',
        'price',
        'isActive',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function certification()
    {
        return $this->belongsTo(Certification::class);
    }
}
