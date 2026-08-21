<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_request_id')
                ->constrained('job_requests')
                ->cascadeOnDelete();

            $table->foreignId('offer_id')
                ->nullable()
                ->constrained('offers')
                ->nullOnDelete();

            $table->foreignId('client_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('worker_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('amount', 10, 2);

            $table->enum('method', ['wallet', 'card', 'cash'])->nullable();

            $table->enum('status', ['pending', 'paid', 'failed'])
                ->default('pending');

            $table->string('transaction_ref')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};