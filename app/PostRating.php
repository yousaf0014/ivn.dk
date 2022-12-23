<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PostRating extends BaseModel
{
    protected $table = 'post_user_ratings';
    //
    protected $fillable = [
        'rate','user_id','post_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function post(){
    	return $this->belongsTo(Post::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}