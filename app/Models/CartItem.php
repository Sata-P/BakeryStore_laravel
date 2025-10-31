<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'cart_item_id'; // ✅ เพิ่มบรรทัดนี้

    protected $fillable = [
        'user_id',    // 👈 ต้องมีบรรทัดนี้
        'prod_id',
        'quantity',
        'unit_price'
    ];

    // ... (โค้ด relationships) ...
    public function product()
    {
        return $this->belongsTo(Product::class, 'prod_id', 'product_id');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
}