<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignPackageByAgent extends Model
{
    protected $table = 'assign_package_by_agents';
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
    	return $this->belongsTo('App\Model\PackagesByAgent','package_id','id');
    }

     public function UserDetails(){
        return $this->belongsTo('App\User','added_by','id');
    }
}
