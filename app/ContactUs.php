<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends BaseModel
{
	protected $table = 'contact_us';
     protected $fillable = [
        'first_name','last_name','email','details'
    ];
}
