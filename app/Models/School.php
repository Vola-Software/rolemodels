<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'id', 'name', 'website', 'city_id', 'address', 'is_approved', 'created_by', 'updated_by', 'deleted_by'
    ];

    protected $casts = [
        'city_id' => 'integer',
        'created_by' => 'integer'
    ];

    public function city()
    {
    	return $this->belongsTo('App\Models\City');
    }

    public function teachers()
    {
    	return $this->hasMany('App\Models\Teacher');
    }
}
