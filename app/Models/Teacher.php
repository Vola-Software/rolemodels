<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id', 'school_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'school_id' => 'integer'
    ];

    public function school()
    {
    	return $this->belongsTo('App\Models\School');
    }

    public function subjects()
    {
    	return $this->belongsToMany('App\Models\Subject', 'subject_teacher')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function schoolVisitRequests()
    {
        return $this->hasMany('App\Models\SchoolVisitRequest');
    }
}
