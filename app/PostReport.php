<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReport extends BaseModel
{
	protected $table = 'post_reports';    

    //
    protected $fillable = [
        'user_id','post_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    public static function boot()
    {
        parent::boot();
    }
}
