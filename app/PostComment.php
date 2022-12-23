<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComment extends BaseModel
{
	protected $table = 'post_user_comments';    

    //
    protected $fillable = [
        'image_path','comment','user_id','post_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function commentRatings(){
        return $this->hasMany(CommentRating::class);
    }
    public function commentUserReport(){
        return $this->belongsToMany(User::class,'comment_reports','post_user_comment_id','user_id');
    }
    public static function boot()
    {
        parent::boot();
    }
}