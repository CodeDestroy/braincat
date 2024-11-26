<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'user_id',
        'test_id',
        'score',
        'max_score',
        
    ];

    public function tests()
    {
        return $this->hasOne(Test::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
