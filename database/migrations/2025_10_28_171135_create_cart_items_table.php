<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('cart_item_id');
            $table->unsignedBigInteger('cart_id')->nullable(); // ยังไม่ใช้ FK ไปตะกร้าโดยตรง
            $table->unsignedBigInteger('prod_id');             // ใช้ชื่อเดียวกับที่ Product อ้าง
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->timestamps();

            // Foreign Key ชี้ product_id ใน products
            $table->foreign('prod_id')
                  ->references('product_id')
                  ->on('products')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
