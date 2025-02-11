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
        //
        DB::statement('ALTER TABLE `courses` MODIFY `start_date` DATE NULL;');
        DB::statement('ALTER TABLE `courses` MODIFY `end_date` DATE NULL;');
        DB::statement('ALTER TABLE `courses` MODIFY `start_time` DATE NULL;');
        DB::statement('ALTER TABLE `courses` MODIFY `end_time` DATE NULL;');
        DB::statement('ALTER TABLE `courses` MODIFY `price` VARCHAR(255) NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        DB::statement('ALTER TABLE `courses` MODIFY `start_date` DATE NOT NULL;');
        DB::statement('ALTER TABLE `courses` MODIFY `end_date` DATE NOT NULL;');
        DB::statement('ALTER TABLE `courses` MODIFY `start_time` DATE NOT NULL;');
        DB::statement('ALTER TABLE `courses` MODIFY `end_time` DATE NOT NULL;');
        DB::statement('ALTER TABLE `courses` MODIFY `price` VARCHAR(255) NOT NULL;');
        //
    }
};
