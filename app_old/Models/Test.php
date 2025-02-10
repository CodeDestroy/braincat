<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
class Test extends Model
{
    use AsSource;
    //
    protected $fillable = [
        'event_id',
        'title',
        'description'
        
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
