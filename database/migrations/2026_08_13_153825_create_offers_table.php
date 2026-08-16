<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            // الطلب اللي العرض ده بيرد عليه
            $table->foreignId('job_request_id')
                ->constrained('job_requests')
                ->cascadeOnDelete();

            // الصنايعي اللي بعت العرض
            $table->foreignId('worker_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('price', 10, 2);   // السعر المقترح
            $table->text('message')->nullable(); // رسالة/تفاصيل مع العرض

            // حالة العرض: لسه معلق / اتقبل / اترفض
            $table->enum('status', ['pending', 'accepted', 'rejected'])
                ->default('pending');

            $table->timestamps();

            // نفس الصنايعي مايبعتش أكتر من عرض على نفس الطلب
            $table->unique(['job_request_id', 'worker_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};