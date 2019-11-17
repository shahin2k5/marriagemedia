<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SliderImages extends Model
{
    protected $table = 'slider_images';
    protected $fillable = [
    	'image',
		'title',
		'added_by',
		'edited_by'
    ];
}
