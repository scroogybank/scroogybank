<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('label_transaction', function (Blueprint $table) {
            $table->foreignUlid('label_ulid')
                ->constrained('labels', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignUlid('transaction_ulid')
                ->constrained('transactions', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_transaction');
    }
};
