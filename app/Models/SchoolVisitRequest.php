<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolVisitRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'teacher_id', 'teacher_status', 'phone_calls_time', 'students_details', 'class_stage_id', 'class_major_id', 'role_model_profession', 'meeting_type', 'visit_time', 'potential_participants_count', 'tech_equipment', 'company_id', 'request_status_id', 'school_year', 'term', 'created_by', 'approved_by', 'approved_at'
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'approved_at' => 'datetime',
        'teacher_id' => 'integer',
        'class_stage_id' => 'integer',
        'class_major_id' => 'integer',
        'company_id' => 'integer',
        'request_status_id' => 'integer',
        'created_by' => 'integer',
        'approved_by' => 'integer'
    ];

    public function teacher()
    {
    	return $this->belongsTo('App\Models\Teacher');
    }

    public function classStage()
    {
        return $this->belongsTo('App\Models\ClassStage');
    }

    public function classMajor()
    {
    	return $this->belongsTo('App\Models\ClassMajor');
    }

    public function company()
    {
    	return $this->belongsTo('App\Models\Company');
    }

    public function schoolVisit()
    {
        return $this->hasOne('App\Models\SchoolVisit');
    }

    public function requestStatus()
    {
        return $this->belongsTo('App\Models\RequestStatus');
    }

    public static function fetchRequestsByAuthUser()
    {
        $visitRequests = self::with(['teacher', 'teacher.user', 'teacher.school', 'classStage', 'classMajor', 'company', 'requestStatus', 'schoolVisit']);
        if(!\Auth::check()){
            //For non-registered users (from homepage)
            $visitRequests = $visitRequests->where('request_status_id', config('consts.REQUEST_STATUS_APPROVED'));
        } elseif (\Auth::user()->role_id === config('consts.ROLE_ID_TEACHER')){
            //For Teachers
            $visitRequests = $visitRequests->where('teacher_id', \Auth::user()->teacher->id);
        } elseif(\Auth::user()->role_id === config('consts.ROLE_ID_PROFESSIONAL') ||
                   \Auth::user()->role_id === config('consts.ROLE_ID_COMPANY_ADMIN') ) {
            $visitRequests = $visitRequests->where('request_status_id', config('consts.REQUEST_STATUS_APPROVED'))
                                            ->where(function ($q) {
                                                $q->whereNull('company_id')->orWhere('company_id', \Auth::user()->professional->company_id);
                                            });
        }

        return $visitRequests->get();
    }

    public static function pendingRequestsQuery()
    {
        return static::where('request_status_id', config('consts.REQUEST_STATUS_PENDING'));
    }
}
