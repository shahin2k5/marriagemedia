<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CityList extends Model
{
    protected $table = 'city_lists';
    protected $fillable = [
    	'country_id',
		'city_name',
		'added_by',
		'edited_by'
    ];

    public function Country(){
    	$this->belongsTo('App\Model\CountryLists', 'country_id', 'id');
    }

}
