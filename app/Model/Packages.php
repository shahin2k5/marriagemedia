<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';
    protected $fillable = [
    	'package_for',
    	'name',
		'validity_days',
		'limit_profiles',
		'price',
		'added_by',
		'edited_by'
    ];
}
