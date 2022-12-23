<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NetworkPost extends BaseModel
{
	protected $table = 'network_posts';

    //
    protected $fillable = [
        'network_id','post_id'
    ];

    public function post(){
    	return $this->belongsTo(post::class);
    }
    public function network(){
    	return $this->belongsTo(network::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}
