<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'is_active',
        'start_date',
        'end_date',
    ];

    
    protected $dates = [
        'start_date',
        'end_date'
    ];
}