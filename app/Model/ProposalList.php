<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProposalList extends Model
{
    protected $table = 'proposal_lists';
    protected $fillable = [
    	'profile_id',
		'proposal_profile_id',
		'id_address',
		'browser',
		'status',
		'added_by',
		'edited_by'
    ];

    public function Profile(){
    	return $this->belongsTo('App\Model\ProfileList','profile_id','id');
    }

    public function ProposalProfile(){
        return $this->belongsTo('App\Model\ProfileList','proposal_profile_id','id');
    }
    
}
