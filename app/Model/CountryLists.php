<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CountryLists extends Model
{
    protected $table = 'country_lists';
    protected $fillable = [
    	'name',
		'added_by',
		'edited_by'
    ];
}
