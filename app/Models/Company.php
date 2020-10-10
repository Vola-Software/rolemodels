<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'website', 'city_id', 'address'
    ];

    protected $casts = [
    	'city_id' => 'integer'
    ];

    public function city()
    {
    	return $this->belongsTo('App\Models\City');
    }
}
