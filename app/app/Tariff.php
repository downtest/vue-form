<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
	// Без updated_at, created_at
	public $timestamps = false;

    protected $fillable = [
    	'name',
    	'price',
    	'days',
    ];
}
