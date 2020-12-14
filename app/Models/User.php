<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'phone', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_id' => 'integer'
    ];

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getFullNamesAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function teacher()
    {
        return $this->hasOne('App\Models\Teacher');
    }

    public function professional()
    {
        return $this->hasOne('App\Models\Professional');
    }

    public function isTeacher()
    {
        return $this->role_id === config('consts.ROLE_ID_TEACHER');
    }

    public function isProfessional()
    {
        return $this->role_id === config('consts.ROLE_ID_PROFESSIONAL');
    }

    public function hasAdminAccess()
    {
        return $this->role_id <= config('consts.ROLE_ID_TFB_ADMIN');
    }

    public function isCompanyAdmin()
    {
        return $this->role_id == config('consts.ROLE_ID_COMPANY_ADMIN');
    }

    public static function fetchTeachers()
    {
        return self::with(['teacher', 'teacher.school', 'teacher.school.city', 'teacher.schoolVisitRequests'])->where('role_id', config('consts.ROLE_ID_TEACHER'))->get();
    }

    public static function fetchProfessionals()
    {
        $userProfessionals = self::join('professionals', 'users.id', '=', 'professionals.user_id')
            ->join('roles', 'role_id', '=', 'roles.id')
            ->join('companies', 'professionals.company_id', '=', 'companies.id')
            ->join('cities', 'companies.city_id', '=', 'cities.id');

        if(\Auth::user()->role_id === config('consts.ROLE_ID_COMPANY_ADMIN')){
            $userProfessionals->where('professionals.company_id', \Auth::user()->professional->company_id);
        }

        return $userProfessionals->select('users.first_name', 'users.last_name', 'roles.name as role_name', 'professionals.position', 'companies.name as company_name', 'cities.name as city_name', 'users.email', 'users.phone', 'users.created_at')
            ->get();
    }

    // public static function fetchProfessionals()
    // {
    //     $professionals = self::with('role');
    //     //$professionals->with('professional');
    //     //dd(\Auth::user()->professional->company_id);
    //     $companyId = \Auth::user()->professional ? \Auth::user()->professional->company_id : 1;
                
    //     //TODO: user better if checks here
    //     if(\Auth::user()->role_id === config('consts.ROLE_ID_COMPANY_ADMIN')){
    //         $professionals->with('professional', function(Builder $query){
    //             dd('test2');
    //             $query->where('company_id', $companyId);
    //         });
    //     } else {
    //         $professionals->with('professional');
    //     }

    //     return $professionals->with(['professional.company', 'professional.company.city', 'professional.schoolVisits'])
    //         ->where('role_id', config('consts.ROLE_ID_PROFESSIONAL'))
    //         ->orWhere('role_id', config('consts.ROLE_ID_COMPANY_ADMIN'))

    //         ->get();
    // }

    public static function fetchAdmins()
    {
        return self::with(['role'])->whereIn('role_id', config('consts.ROLE_ID_ADMINS_ARR'))->get();
    }
}
