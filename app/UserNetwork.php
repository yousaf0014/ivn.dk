<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNetwork extends BaseModel
{
    protected $table = 'user_networks';
    //
    protected $fillable = [
        'user_id','network_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function networks(){
    	return $this->belongsTo(Network::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}
