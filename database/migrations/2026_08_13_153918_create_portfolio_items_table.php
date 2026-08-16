<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();

            // الصنايعي صاحب شغلانة البورتفوليو دي
            $table->foreignId('worker_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');           // مثال: "تركيب مطبخ خشب زان"
            $table->text('description')->nullable();
            $table->string('image_path')->nullable(); // مسار الصورة بعد الرفع

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};