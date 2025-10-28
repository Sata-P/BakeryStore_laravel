<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // สร้างสินค้า 50 ชิ้นจาก Factory
        Product::factory()->count(10)->create(); 
    }
}