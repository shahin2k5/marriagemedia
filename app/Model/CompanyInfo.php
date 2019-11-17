<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $table = 'company_infos';
    protected $fillable = [
    	'company_name',
		'address',
		'phone',
		'mobile_no',
		'email',
		'logo',
		'added_by',
		'edited_by'
    ];
}
