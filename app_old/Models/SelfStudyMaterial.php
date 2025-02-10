<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class SelfStudyMaterial extends Model
{
    //
    use AsSource;
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
