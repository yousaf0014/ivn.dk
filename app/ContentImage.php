<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentImage extends BaseModel
{
    //
    protected $fillable = [
        'title','path','url','description'
    ];

    public function content(){
    	return $this->belongsTo(Content::class);
    }
}
