<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends BaseModel
{
     protected $fillable = [
        'key','details'
    ];

    public static function  getValBykey($key){
    	$text = New Text;
    	return $text->where('key',$key)->value('details');
    }
}
