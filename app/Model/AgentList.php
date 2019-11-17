<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AgentList extends Model
{
    protected $table = 'agent_lists';
    protected $fillable = [
    	'client_id',
		'full_name',
		'company_name',
		'address',
		'mobile_no',
		'icon',
		'cover_photo',
		'status',
		'paid_status',
		'added_by',
		'edited_by'
    ];

    public function UserDetails(){
    	return $this->belongsTo('App\User', 'client_id', 'id');
    }

}
