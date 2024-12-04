<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'theme_id',
        'text',
        'isAnonymous',
        'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function themes()
    {
        return $this->belongsTo(Theme::class);
    }
}
