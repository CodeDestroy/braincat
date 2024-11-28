<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVebinarToken extends Model
{
    use HasFactory;

    protected $fillable = ['vebinar_id', 'user_id', 'token_id'];

    public function vebinar()
    {
        return $this->belongsTo(Vebinar::class);
    }

    public function token()
    {
        return $this->belongsTo(VebinarToken::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

