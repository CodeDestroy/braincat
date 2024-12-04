<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'description',
        'course_id',
        /* 'score',
        'max_score',
        'passed' */
        
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
