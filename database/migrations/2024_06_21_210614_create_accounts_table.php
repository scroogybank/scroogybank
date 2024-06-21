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
        Schema::create('accounts', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->string('icon', 255)->nullable();
            $table->string('main_currency', 3);
            $table->bigInteger('original_balance')->default(0);
            $table->boolean('archived')->default(false);
            $table->date('opening_date');
            $table->timestamps();

            $table->foreignUlid('user_ulid')
                ->constrained('users', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignUlid('account_group_ulid')
                ->constrained('account_groups', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
