<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AgentAssignPackages extends Model
{
    protected $table = 'agent_assign_packages';
    protected $fillable = [
    	'profile_id',
		'package_id',
		'expire_date',
        'payment_id',
		'added_by',
		'edited_by'
    ];

    public function AgentProfile(){
    	return $this->belongsTo('App\Model\AgentList','profile_id','id');
    }

    public function Package(){
    	return $this->belongsTo('App\Model\PackagesByAgent','package_id','id');
    }

    public function UserDetails(){
        return $this->belongsTo('App\User','added_by','id');
    }
    
}
