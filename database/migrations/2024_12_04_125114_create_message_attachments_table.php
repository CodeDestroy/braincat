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
        Schema::create('message_attachments', function (Blueprint $table) {
            $table->id();
            /* 'user_id',
        'theme_id',
        'text',
        'isAnonymous',
        'status' */
            $table->foreignId('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->string('file')->default('');
            $table->string('type')->default('');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_attachments');
    }
};
