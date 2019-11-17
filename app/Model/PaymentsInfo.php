<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentsInfo extends Model
{
    protected $table = 'payments_infos';
    protected $fillable = [
    	'profile_id',
		'client_type',
		'package_id',
		'payment_method',
		'mobile_no',
		'trans_id',
		'amount',
		'added_by',
		'verified_by'
    ];

    public function PackageInfo(){
    	return $this->belongsTo('App\Model\Packages', 'package_id','id');
    }
}
