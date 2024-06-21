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
        Schema::create('transactions', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->string('name', 255);
            $table->bigInteger('amount');
            $table->string('currency', 3);
            $table->text('note')->nullable();
            $table->timestamp('registered_at');
            // "Cleared" means it was a downloaded transaction from my bank.
            // "Reconciled" means I have reconciled my statement (paper or pdf) against my account.
            // Typically transactions will go from "blank" (none) to "Cleared" to "Reconciled" over the course of a month.
            $table->enum('status', ['cleared', 'reconciled'])->nullable();
            $table->string('external_id', 255)->nullable();
            $table->timestamps();

            $table->foreignUlid('user_ulid')
                ->constrained('users', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
