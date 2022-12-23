<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Facades\Auth;
use App\UserAdvert;

class User extends Authenticatable
{
    use Notifiable;
    use AuthenticableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description','first_name','last_name','initials','username','gender', 'email','cpr','address','address2','housenumber','floor','zipcode',
        'area','city','country','mobile_phone','phone','fax','date_of_birth','profile_image','entrepreneurial_status','job_title','education','Primary occupation',
        'user_type','user_subscription','fb_merge','fb_email','password','entrepreneurial_status','header_image','business_page_title','news_letter','facebook_id','url'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userSubscription(){
        return $this->hasMany(Subscription::class);
    }

    public function userPostReport(){
        return $this->belongsToMany(Post::class,'post_reports','user_id','post_id');
    }

    
    public function getBusiness(){
        return $this->where('user_type','business')->get();
    }

    public function getUserSubscribedBusiness($userID){
        $businessList = UserAdvert::where('user_id',$userID)->get();
        $idList = array();
        foreach($businessList  as $bd){
            $idList[$bd->business_user_id] = $bd->business_user_id;
        }
        return $this->whereIn('id',$idList)->where('user_type','business')->get();
    }

    public function getNotSubcribedBusiness($userID){
        $businessList = UserAdvert::where('user_id',$userID)->get();
        $idList = array();
        foreach($businessList  as $bd){
            $idList[$bd->business_user_id] = $bd->business_user_id;
        }
        return $this->whereNotIn('id',$idList)->where('user_type','business')->get();
    }

    public function userCommentReport(){
        return $this->belongsToMany(CommentReport::class,'comment_reports','user_id','post_user_comment_id');
    }

    public function post(){
        return $this->hasMany(Comment::class);
    }

    public function companies(){
        return $this->hasMany(Company::class);
    }

    public function comment(){
        return $this->hasMany(PostComment::class);
    }
    
    public function userNetworks()
    {
        return $this->belongsToMany(Network::class,'user_networks','user_id','network_id');
    }

    public function commentedPosts()
    {
        return $this->belongsToMany(Post::class,'post_user_comments','user_id','post_id');
    }

    public function like(){
        return $this->hasMany(PostLike::class);
    }

    public function likedPost(){
        return $this->belongsToMany(Post::class,'post_user_likes','user_id','post_id');
    }


    public function rating(){
        return $this->hasMany(PostRating::class);
    }

    public function ratedPost(){
        return $this->belongsToMany(Post::class,'post_user_ratings','user_id','post_id');
    }

    public function tag(){
        return $this->hasMany(PostTag::class);
    }

    public function tagedPost(){
        return $this->belongsToMany(Post::class,'post_user_tags','user_id','post_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
       {
             $userid = (!Auth::guest()) ? Auth::user()->id : null ;
             $model->created_by = $userid;
        });

        static::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->updated_by = $userid;
        });
    }
}
