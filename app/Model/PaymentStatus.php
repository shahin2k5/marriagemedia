<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_statuses';
    protected $fillable = [
    	'profile_id',
    	'status',
		'added_by',
		'edited_by'
    ];

    public function Profile(){
    	return $this->belongsTo('App\Model\ProfileList', 'profile_id','id');
    }
}
