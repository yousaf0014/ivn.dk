<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    protected $fillable = [
        'title','url','image_path','details'
    ];

    public function network(){
    	return $this->hasMany(Network::class);
    }
}
