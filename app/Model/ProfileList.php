<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProfileList extends Model
{
    protected $table = 'profile_lists';
    protected $fillable = [
    	'client_id',
    	'full_name',
		'sex',
		'date_of_birth',
		'height',
		'height_numeric',
		'weight',
		'religion',
		'marital_status',
		'education',
		'body_type',
		'drink',
		'smoke',
		'diet',
		'blood_group',
		'complexion',
		'beard',
		'mustache',
		'appearance',
		'mother_tongue',
		'age',
		'occupation',
		'annual_income',
		'fathers_name',
		'fathers_occupation',
		'mothers_name',
		'mothers_occupation',
		'siblings',
		'family_values',
		'photo',
		'mobile_no',
		'address',
		'permanent_address',
		'city',
		'country',
		'publish_status',
		'profile_status',
		'paid_status',
		'complete_status',
		'added_by',
		'agent_id',
		'edited_by'
    ];

    public function Emails(){
    	return $this->belongsTo('App\User','client_id','id');
    }

    public function AssignPackage(){
    	return $this->belongsTo('App\Model\AssignPackage','id','profile_id');
    }

    public function AssignPackageByAgent(){
    	return $this->belongsTo('App\Model\AssignPackageByAgent','id','profile_id');
    }

}
