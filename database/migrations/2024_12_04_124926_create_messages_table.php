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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            /* 'user_id',
        'theme_id',
        'text',
        'isAnonymous',
        'status' */
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->text('text');
            $table->boolean('isAnonymous')->default(false);
            $table->string('status')->default('notRead');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
