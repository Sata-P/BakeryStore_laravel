<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // 👈 เพิ่ม

class OrderItem extends Model
{
    use HasFactory;

    /**
     * บอก Model ว่าตารางนี้ไม่มี created_at, updated_at
     * (ตาม ER Diagram ของคุณ)
     */
    public $timestamps = false; 

    /**
     * อนุญาตให้บันทึก field เหล่านี้ (ป้องกัน MassAssignmentException)
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    // 👇 (เพิ่มความสัมพันธ์เผื่อไว้ใช้ในอนาคต)
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}