<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatUsers extends Model
{
    protected $fillable = [
        'name',
        'chat_id',
        'user_id',
        /* 'score',
        'max_score',
        'passed' */
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
