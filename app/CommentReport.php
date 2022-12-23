<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReport extends BaseModel
{
	protected $table = 'comment_reports';    

    //
    protected $fillable = [
        'user_id','post_user_comment_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->belongsTo(PostComment::class,'post_user_comment_id');
    }
    
    public static function boot()
    {
        parent::boot();
    }
}
