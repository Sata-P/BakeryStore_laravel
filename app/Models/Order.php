<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // 👈 เพิ่ม use
use Illuminate\Database\Eloquent\Relations\HasMany; // 👈 เพิ่ม use

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // 👇 นี่คือส่วนที่ต้องเพิ่ม/แก้ไข
    protected $fillable = [
        'user_id',
        'coupon_id',
        'status',
        'total_amount',
        'shipping_name',
        'shipping_address',
        'shipping_phone',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}