<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    protected $table = 'admin_messages';
    protected $fillable = [
    	'profile_id',
		'status',
		'title',
		'description',
		'added_by',
		'edited_by'
    ];

    public function Profile(){
    	return $this->belongsTo('App\Model\ProfileList', 'profile_id', 'id');
    }
}
