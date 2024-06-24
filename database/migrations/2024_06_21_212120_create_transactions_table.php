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
            $table->ulid('collection_ulid')->nullable();
            $table->string('name', 255);
            $table->bigInteger('amount');
            $table->string('currency', 3);
            $table->text('note')->nullable();
            $table->timestamp('registered_at');
            $table->enum('status', ['cleared', 'reconciled'])
                ->nullable()
                ->comment("\"Cleared\" means it was a downloaded transaction from my bank. \"Reconciled\" means I have reconciled my statement (paper or pdf) against my account. Typically transactions will go from \"blank\" (none) to \"Cleared\" to \"Reconciled\" over the course of a month.");
            $table->string('external_id', 255)->nullable();
            $table->timestamps();

            $table->foreignUlid('user_ulid')
                ->comment('The user that performed this transaction.')
                ->constrained('users', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignUlid('account_ulid')
                ->comment('The account this transaction belongs to.')
                ->constrained('accounts', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignUlid('category_ulid')
                ->comment('The category this transaction belongs to.')
                ->constrained('categories', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        // Must be separate due to foreign key constraints
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignUlid('transfer_from_ulid')
                ->nullable()
                ->comment('A transfer has an associated transaction that is the source of the transfer.')
                ->constrained('transactions', 'ulid')
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
