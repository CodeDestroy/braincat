<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageAttachment extends Model
{
    protected $fillable = [
        'message_id',
        'file',
        'type',
    ];

    public function message()
    {
        return $this->hasOne(Message::class);
    }
}
