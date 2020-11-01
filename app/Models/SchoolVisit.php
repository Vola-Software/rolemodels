<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolVisit extends Model
{
    protected $fillable = [
        'school_visit_request_id', 'professional_id', 'date'
    ];

    protected $casts = [
        'date' => 'date',
        'school_visit_request_id' => 'integer',
        'professional_id' => 'integer'
    ];

    public function schoolVisitRequest()
    {
    	return $this->belongsTo('App\Models\SchoolVisitRequest');
    }

    public function professional()
    {
    	return $this->belongsTo('App\Models\Professional');
    }

    public static function fetchMyVisits()
    {
        return self::with(['schoolVisitRequest', 'schoolVisitRequest.teacher', 'schoolVisitRequest.teacher.user', 'schoolVisitRequest.teacher.school', 'schoolVisitRequest.classStage', 'schoolVisitRequest.classMajor', 'schoolVisitRequest.company', 'schoolVisitRequest.requestStatus'])->where('professional_id', \Auth::user()->professional->id)->get();
    }
}