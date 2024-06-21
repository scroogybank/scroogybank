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
        Schema::create('tag_transaction', function (Blueprint $table) {
            $table->foreignUlid('tag_ulid')
                ->constrained('tags', 'ulid')
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
        Schema::dropIfExists('tag_transaction');
    }
};
