<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends BaseModel
{
    //
    protected $fillable = [
        'name','type','cvr','address1','house_no','address2','zip','city','email','url','Entrepreneurial_status','weekly_hours','job_type'
    ];

    public function content(){
    	return $this->belongsTo(User::class);
    }
}
