<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
    protected $fillable = [
        'name',
        'course_id',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time'
        /* 'score',
        'max_score',
        'passed' */
        /* $table->string('name');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('description');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable(); */
        
    ];

    public function course()
    {
        return $this->hasOne(Course::class);
    }

    public function themes()
    {
        return $this->hasMany(Theme::class);
    }
}
