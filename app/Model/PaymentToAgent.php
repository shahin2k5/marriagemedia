<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentToAgent extends Model
{
    protected $table = 'payment_to_agents';
    protected $fillable = [
    	'profile_id',
		'package_id',
		'payment_method',
        'mobile_no',
		'trans_id',
		'amount',
		'added_by',
		'verified_by'
    ];

    public function Profile(){
        return $this->belongsTo('App\Model\ProfileList', 'profile_id','id');
    }

    public function PackageInfo(){
    	return $this->belongsTo('App\Model\PackagesByAgent', 'package_id','id');
    }

    
}
