<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Attachment\Attachable;

class Group extends Model
{
    //
    use AsSource;
    use Attachable;
    protected $fillable = [
        'image',
        'color',
        'name',
        'description',
        'href',
        'alias'
        
        
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_group');
    }

}
