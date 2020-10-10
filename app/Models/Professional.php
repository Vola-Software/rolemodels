<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $fillable = [
        'user_id', 'company_id', 'position'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'company_id' => 'integer'
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function company()
    {
    	return $this->belongsTo('App\Models\Company');
    }

    public function schoolVisits()
    {
        return $this->hasMany('App\Models\SchoolVisit');
    }
}
