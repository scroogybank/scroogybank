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
        Schema::create('categories', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->enum('kind', ['expense', 'income', 'transfer', 'receivables', 'payables', 'system']);
            $table->string('name', 255);
            $table->string('icon', 255)->nullable();
            $table->integer('color')->nullable();
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreignUlid('user_ulid')
                ->constrained('users', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreignUlid('main_category_ulid')
                ->nullable()
                ->constrained('categories', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropConstrainedForeignId('main_category_ulid');
        });
        Schema::dropIfExists('categories');
    }
};
