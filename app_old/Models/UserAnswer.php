<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    //
    protected $fillable = [
        'user_id',
        'test_id',
        'answer_id',
        'score',
        'textAnswer'
               
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function test()
    {
        return $this->belongsTo(Tests::class);
    }
    
    public function answer()
    {
        return $this->belongsTo(Answers::class);
    }
}
