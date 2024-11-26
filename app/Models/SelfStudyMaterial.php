<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelfStudyMaterial extends Model
{
    //
    protected $fillable = [
        'event_id',
        'text',
        'title',
        'description',
        
    ];

    public function events()
    {
        return $this->belongsTo(Event::class);
    }
}
