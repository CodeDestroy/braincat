<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'name',
        'theme_id',
        'course_id',
        /* 'score',
        'max_score',
        'passed' */
        
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
