<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('prod_id')
                  ->constrained('products', 'product_id')
                  ->cascadeOnDelete(); // ✅ ให้ชี้ product_id ถูกต้อง
            $table->date('review_date')->useCurrent();
            $table->tinyInteger('rating'); // 1–5
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'prod_id']); // คนเดียวรีวิวซ้ำไม่ได้
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
