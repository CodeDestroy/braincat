<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $fillable = [
        'event_id',
        'title',
        'description'
        
    ];

    public function events()
    {
        return $this->belongsTo(Event::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
