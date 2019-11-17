<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LinkList extends Model
{
    protected $table = 'link_lists';
    protected $fillable = [
    	'image_icon',
		'design_icon',
		'title',
		'url',
		'added_by',
		'edited_by'
    ];
}
