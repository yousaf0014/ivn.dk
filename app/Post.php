<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends BaseModel
{
    public static function boot()
    {
        parent::boot();
    }
    //
    protected $fillable = [
        'title','image_path','details','user_id','can_edit','category_id','network_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function postImages(){
    	return $this->hasMany(PostImage::class);
    }

    public function postUserReport(){
        return $this->belongsToMany(User::class,'post_reports','post_id','user_id');
    }

    public function postComment(){
    	return $this->hasMany(PostComment::class);
    }

    public function commentedUser(){
    	return $this->belongsToMany(User::class,'post_user_comments','post_id','user_id');
    }

    public function postLike(){
    	return $this->hasMany(PostLike::class);
    }
    
    public function likedUser(){
    	return $this->belongsToMany(User::class,'post_user_likes','post_id','user_id');
    }


    public function postRating(){
    	return $this->hasMany(PostRating::class);
    }

    public function RatedUser(){
    	return $this->belongsToMany(User::class,'post_user_ratings','post_id','user_id');    	
    }

    public function postTag(){
    	return $this->hasMany(PostTag::class);
    }

    public function TagedUser(){
    	return $this->belongsToMany(User::class,'post_user_tags','post_id','user_id');   
    }

    public function networks(){
        return $this->belongsToMany(Network::class,'network_posts','post_id','network_id');       
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'user_id');          
    }        
}
