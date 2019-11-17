<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FavoriteList extends Model
{
    protected $table = 'favorite_lists';
    protected $fillable = [
    	'profile_id',
		'fav_profile_id',
		'id_address',
		'browser',
		'added_by',
		'edited_by'
    ];

    public function Profile(){
    	return $this->belongsTo('App\Model\ProfileList','profile_id','id');
    }

    public function FavoriteProfile(){
        return $this->belongsTo('App\Model\ProfileList','fav_profile_id','id');
    }
    
}
