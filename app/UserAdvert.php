<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAdvert extends BaseModel
{
    protected $table = 'user_adverts';
    //
    protected $fillable = [
        'user_id','business_user_id'
    ];

    /*public function user(){
    	return $this->belongsTo(User::class);
    }
    public function advert(){
    	return $this->belongsTo(Post::class);
    } */

    public static function boot()
    {
        parent::boot();
    }
}
