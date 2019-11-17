<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{
    protected $table = 'preferences';
    protected $fillable = [
    	'profile_id',
		'client_id',
		'from_age',
		'to_age',
		'from_height',
		'from_height_numeric',
		'to_height',
		'to_height_numeric',
		'religion',
		'marital_status',
		'beard',
		'mustache',
		'appearance',
		'education',
		'body_type',
		'drink',
		'smoke',
		'diet',
		'complexion',
		'occupation',
		'from_annual_income',
		'to_annual_income',
		'country',
		'city',
		'added_by',
		'edited_by'
    ];
}
