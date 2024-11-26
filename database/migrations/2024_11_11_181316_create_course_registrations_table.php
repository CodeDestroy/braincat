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
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->boolean('isAPPCP')->default(false);
            
            $table->boolean('isHealthyChild')->default(false)->comment('old health child');
            $table->boolean('isHealthyChildGk')->default(false);
            $table->boolean('isHealthyChildFranch')->default(false);
            $table->boolean('isLegalHealthyChildGK')->default(false);
            $table->boolean('isLegalHealthyChildFranch')->default(false);
            
            $table->boolean('isHealthyChildPartner')->default(false);
            $table->boolean('isLegalHealthyChildPartner')->default(false);
            

            $table->boolean('isStudent')->default(false);
            $table->boolean('isLegal')->default(false);
            $table->boolean('shouldBeCheckedOut')->default(false);
            $table->boolean('managerCheckedOut')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_registrations');
    }
};
