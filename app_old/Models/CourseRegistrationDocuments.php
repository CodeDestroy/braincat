<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRegistrationDocuments extends Model
{
    protected $fillable = [
        'courseRegistrationId',
        'type',
        'file',       
    ];

    public function courseRegistrations()
    {
        return $this->belongsTo(CourseRegistration::class);
    }
}
