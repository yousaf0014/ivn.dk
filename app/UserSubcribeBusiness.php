<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubcribeBusiness extends BaseModel
{
    protected $table = 'user_business';
    //
    protected $fillable = [
        'user_id','network_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function business()
    {
        return $this->belongsTo(User::class,'user_business','business_id','User.id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
