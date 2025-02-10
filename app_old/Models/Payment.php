<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'course_id',
        'freq',
        'payment_number',
        'order_number',
        'payment_method',
        'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
