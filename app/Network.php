<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends BaseModel
{
    protected $fillable = [
        'title','url','image_path','details','category_id'
    ];

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function posts(){
        return $this->belongsToMany(Post::class,'network_posts');       
    }

    public static function boot()
    {
        parent::boot();
    }
}