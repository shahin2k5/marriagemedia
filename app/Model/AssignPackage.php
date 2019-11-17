<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignPackage extends Model
{
    protected $table = 'assign_packages';
    protected $fillable = [
    	'profile_id',
		'package_id',
		'expire_date',
        'payment_id',
		'added_by',
		'edited_by'
    ];

    public function Profile(){
    	return $this->belongsTo('App\Model\ProfileList','profile_id','id');
    }

    public function Package(){
    	return $this->belongsTo('App\Model\Packages','package_id','id');
    }

     public function UserDetails(){
        return $this->belongsTo('App\User','added_by','id');
    }

    
}
