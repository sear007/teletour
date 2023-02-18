<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $appends = array('feature_image', 'fake_feature_image');
    public function image(){
        return $this->hasOne(RoomTypeImage::class);    
    }
    public function getFeatureImageAttribute()
    {
        if($this->image){
            return url('/').'/images/branch_photo/'.$this->image->filename; 
        } 
        return '';
    }
    public function getFakeFeatureImageAttribute()
    {
        return 'https://loremflickr.com/640/480/room?random='.$this->id;  
    }
}
