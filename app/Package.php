<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends BaseModel
{
    //
    protected $fillable = [
        'title','details','price','price_inc_vat','reepay_plan_id','image_path','active'
    ];
}
