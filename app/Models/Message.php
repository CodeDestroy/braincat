<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
class Message extends Model
{
    use AsSource;
    protected $fillable = [
        'user_id',
        'theme_id',
        'text',
        'isAnonymous',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function attachments()
    {
        return $this->hasMany(MessageAttachment::class);
    }
}
