<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends BaseModel
{
    //
    protected $fillable = [
        'parent_id','title','link_title','meta_title_content','short_description','content','page_keywords','page_description','url'
        ,'content_for','show_on_top','show_on_homepage','show_on_bottom','show_in_footer','sequence','image_path','image_title',
        'image_details','show_image','show_gallery','is_page','is_published','extra_content'
    ];

    public function contentImage(){
    	return $this->hasMany(ContentImage::class);
    }

    /**
	 * Laravel provides a boot method which is 'a convenient place to register your event bindings.'
	 * See: https://laravel.com/docs/4.2/eloquent#model-events
	 */
	/*public static function boot()
	{
	    parent::boot();
	    // registering a callback to be executed upon the creation of an activity AR
	    static::creating(function($content) {

	        // produce a slug based on the activity title
	        $uuid = uniqid();

	        // check to see if any other slugs exist that are the same & count them
	        $count = static::whereRaw("uuid RLIKE '^{$uuid}(-[0-9]+)?$'")->count();

	        // if other slugs exist that are the same, append the count to the slug
	        $content->uuid = $count ? "{$uuid}-{$count}" : $uuid;

	    });

	}*/

	public static function getManu(){
        $contentObj = new Content;
        $contents = $contentObj->orderBy('sequence','ASC')->where('is_published',1)->select('id','parent_id' ,'title','content_for')->get(); 
        $contentsList = array();
        $mainArr = $childArr = array();
        foreach($contents as $cnt){
            if(!empty($cnt->parent_id)){
                $childArr[$cnt->parent_id] = $cnt->parent_id; 
            }
            $mainArr[$cnt->id] =  $cnt->toArray();
        }
        while(!empty($childArr)){
            foreach($mainArr as $id=>$cnt){
                if(!isset($childArr[$cnt['id']])){
                    if(!empty($cnt['parent_id'])){
                        $mainArr[$cnt['parent_id']]['child'][] = $cnt;
                        unset($mainArr[$id]);unset($mainArr[$id]['child']);
                    }
                    
                }
            }
            $childArr = array();
            foreach($mainArr as $id=>$cnt){
                if(!empty($cnt['parent_id'])){
                    $childArr[$cnt['parent_id']] = $cnt['parent_id'];
                }
            }
        }
        return $mainArr;
    }
}
