<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
class Course extends Model
{

    use AsSource;
    protected $fillable = [
        'name',
        'description',
        'image',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status',
        'price',
        'canAskQuestion',
        'url'
        
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class,'course_group');
    }
}
