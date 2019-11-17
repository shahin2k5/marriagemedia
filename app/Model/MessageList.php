<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MessageList extends Model
{
    protected $table = 'message_lists';
    protected $fillable = [
    	'sender_profile_id',
		'receiver_profile_id',
		'title',
		'description',
		'status',
		'added_by',
		'edited_by'
    ];

    public function SenderProfile(){
    	return $this->belongsTo('App\Model\ProfileList','sender_profile_id','id');
    }

    public function ReceiverProfile(){
        return $this->belongsTo('App\Model\ProfileList','receiver_profile_id','id');
    }
}
