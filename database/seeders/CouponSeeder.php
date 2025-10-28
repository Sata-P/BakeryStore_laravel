<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
public function run(): void
{
    // 1. คูปองลด 10%
    Coupon::create([
        'code' => 'SALE10',
        'type' => 'percent',
        'value' => 10,
    ]);

    // 2. คูปองลด 50 บาท (fixed)
    Coupon::create([
        'code' => '50OFF',
        'type' => 'fixed',
        'value' => 50,
    ]);

    // 3. คูปองหมดอายุ
    Coupon::create([
        'code' => 'EXPIRED',
        'type' => 'fixed',
        'value' => 100,
        'end_date' => now()->subDay(), // หมดอายุเมื่อวาน
    ]);
}
}
