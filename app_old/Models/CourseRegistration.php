<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    protected $fillable = [
        'user_id',
        'shouldBeCheckedOut',
        'course_id',
        'isAPPCP',
        'isHealthyChildGk',
        'isHealthyChildFranch',
        'isLegalHealthyChildGK',
        'isHealthyChildPartner',
        'isLegalHealthyChildPartner',
        'isStudent',
        'isLegalHealthyChildFranch',
        'managerCheckedOut',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
}
