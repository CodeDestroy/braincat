<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Attachment\Attachable;
class Event extends Model
{
    use AsSource;
    use Attachable;
    protected $fillable = [
        'name',
        'description',
        'course_id',
        'image',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status',
        'order',
        'color',
        'theme_id'
        
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getFullAttribute(): string
    {
        return sprintf('%s (%s)', $this->name, $this->start_date);
    }

    public function scopeType(Builder $query, $type)
    {
        return $query->where('type', $type);
    }
}
