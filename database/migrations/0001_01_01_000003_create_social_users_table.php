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
        Schema::create('social_users', function (Blueprint $table) {
            $table->foreignUlid('user_ulid')
                ->constrained('users', 'ulid')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('provider_user_id');
            $table->string('provider');
            $table->timestamps();

            $table->unique(['provider_user_id', 'provider']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_users');
    }
};
