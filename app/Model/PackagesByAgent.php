<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PackagesByAgent extends Model
{
    protected $table = 'packages_by_agents';
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
