<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentRating extends BaseModel
{
    protected $table = 'comment_user_ratings';
    //
    protected $fillable = [
        'rate','user_id','comment_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function comment(){
    	return $this->belongsTo(PostComment::class,'comment_id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
