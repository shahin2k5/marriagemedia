<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'team_members';
    protected $fillable = [
    	'full_name',
		'designation',
		'photo',
		'added_by',
		'edited_by'
    ];
}
