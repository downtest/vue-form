<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    	'name',
    	'phone',
    ];

    public function tariffs()
    {
    	return $this->belongsToMany('App\Tariff')->withPivot('first_day', 'address', 'created_at');
    }
}
