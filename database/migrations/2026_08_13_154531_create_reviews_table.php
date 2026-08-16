<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // الطلب اللي التقييم ده عليه
            $table->foreignId('job_request_id')
                ->constrained('job_requests')
                ->cascadeOnDelete();

            // العميل اللي كتب التقييم
            $table->foreignId('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // الصنايعي اللي بيتقيّم
            $table->foreignId('worker_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('rating'); // من 1 لـ 5
            $table->text('comment')->nullable();

            $table->timestamps();

            // العميل يقيّم نفس الطلب مرة واحدة بس
            $table->unique(['job_request_id', 'client_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};