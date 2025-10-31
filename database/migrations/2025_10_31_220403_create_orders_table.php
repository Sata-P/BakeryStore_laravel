<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); 
        $table->foreignIdFor(\App\Models\User::class)->constrained(); 
        $table->foreignIdFor(\App\Models\Coupon::class)->nullable()->constrained();

        $table->string('status')->default('pending'); 
        $table->decimal('total_amount', 10, 2); 

        // 👇 นี่คือ 3 คอลัมน์สำหรับที่อยู่ (ต้องมีแค่นี้)
        $table->string('shipping_name');
        $table->string('shipping_address');
        $table->string('shipping_phone');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};