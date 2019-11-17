<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Viewers extends Model
{
    protected $table = 'viewers';
    protected $fillable = [
    	'profile_id',
		'view_profile_id',
		'id_address',
		'browser',
		'added_by',
		'edited_by'
    ];

    public function Profile(){
    	return $this->belongsTo('App\Model\ProfileList','profile_id','id');
    }

    public function ViewProfile(){
        return $this->belongsTo('App\Model\ProfileList','view_profile_id','id');
    }
}
