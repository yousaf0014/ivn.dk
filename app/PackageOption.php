<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageOption extends BaseModel
{
    //
    protected $table = 'package_options'; 
    protected $fillable = [
        'text','basic','silver','gold','active','details','add_text'
    ];
}
