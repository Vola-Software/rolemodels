<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
	public $timestamps = false;
	use SoftDeletes;

    protected $fillable = [
        'name', 'type', 'region_id'
    ];

    protected $casts = [
        'region_id' => 'integer',
        'type' => 'integer'
    ];

    public function region()
    {
    	return $this->belongsTo('App\Models\Region');
    }

    public function schools()
    {
    	return $this->hasMany('App\Models\School');
    }
}
