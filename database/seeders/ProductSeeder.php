<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        $items = [
            [
                'name' => 'สตรอว์เบอร์รีชอร์ตเค้ก',
                'description' => 'เค้กสปันจ์นุ่มๆ ครีมสด หอมหวาน ตัดด้วยสตรอว์เบอร์รีสด',
                'image_url' => '/imgs/cake.jpg',
                'price' => 189.00,
                'stock_qty' => 40,
            ],
            [
                'name' => 'ช็อกโกแลตฟัดจ์',
                'description' => 'ช็อกโกแลตเข้มข้น หน้าเฟัดจ์หนึบ หอมกลิ่นโกโก้',
                'image_url' => '/imgs/cake.jpg',
                'price' => 209.00,
                'stock_qty' => 30,
            ],
            [
                'name' => 'ชีสเค้กญี่ปุ่น',
                'description' => 'ชีสเค้กนุ่มเด้ง ละลายในปาก สูตรหวานน้อย',
                'image_url' => '/imgs/cake.jpg',
                'price' => 169.00,
                'stock_qty' => 25,
            ],
            [
                'name' => 'ทาร์ตผลไม้รวม',
                'description' => 'ทาร์ตกัดกรุบ ไส้คัสตาร์ดหอมวนิลา โรยผลไม้ตามฤดูกาล',
                'image_url' => '/imgs/cake.jpg',
                'price' => 149.00,
                'stock_qty' => 20,
            ],
        ];

        foreach ($items as $it) {
            Product::create($it + ['category_id' => null]);
        }
    }
}