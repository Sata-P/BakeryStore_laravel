<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    protected $fillable = ['category_id','name','description','image_url','price','stock_qty'];

    public function reviews()  { return $this->hasMany(Review::class, 'prod_id'); }
    public function category() { return $this->belongsTo(Category::class, 'category_id'); }

    public function scopeSearch($q, $term)
    {
        if (!$term) return;
        $q->where(fn($x)=>$x->where('name','like',"%$term%")
                            ->orWhere('description','like',"%$term%"));
    }

    public function avgRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}