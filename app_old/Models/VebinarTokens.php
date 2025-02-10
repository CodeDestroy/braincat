<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VebinarToken extends Model
{
    use HasFactory;

    protected $fillable = ['jwt_token'];

    public function userTokens()
    {
        return $this->hasMany(UserVebinarToken::class);
    }
}
