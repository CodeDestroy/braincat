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
        Schema::table('course_registrations', function (Blueprint $table) {
            /* $table->integer('course_id')->unsigned(); */
            $table->foreignId('course_id')->constrained('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_registrations', function (Blueprint $table) {
            //
            $table->dropForeign('course_registrations_course_id_foreign');
            $table->dropColumn('course_id');
        });
    }
};
