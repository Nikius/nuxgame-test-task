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
        Schema::create('user_auth_tokens', function (Blueprint $table) {
            $table->uuid();
            $table->foreignId('user_id');
            $table->timestamp('expires_at');
            $table->timestamp('created_at');

            $table->foreign('user_id')
                ->references('id')
                ->on('registered_users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_auth_tokens');
    }
};
