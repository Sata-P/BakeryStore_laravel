<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // 👈 2. เพิ่มบรรทัดนี้

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // (อย่าลืม $fillable ที่เราคุยกันไว้ด้วยนะครับ)
        'name',
        'description',
        'price',
    ];
}