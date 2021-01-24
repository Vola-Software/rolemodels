<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleModelPoll extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function schoolVisit()
    {
    	return $this->belongsTo('App\Models\SchoolVisit');
    }

    public function professional()
    {
    	return $this->belongsTo('App\Models\Professional');
    }
}
