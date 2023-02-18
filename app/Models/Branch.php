<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = array(
        'feature_image', 
        'fake_feature_image',
        'fake_photos',
        'photos',
    );
    public function rooms(){
        return $this->hasMany(RoomType::class);
    }
    public function getPhotosAttribute(){
        $path = url('/').'/images/branch_photo/';
        $data = $this->photos()->get();
        $images = [];
        foreach($data as $key => $image){
            $images[$key] = $path.$image->filename;
        }
        return $images;
    }
    public function photos(){
        return $this->hasMany(BranchImage::class);
    }
    
    public function getFeatureImageAttribute(){
        return url('/').'/images/branch_photo/'.$this->photo;
    }
    public function getFakeFeatureImageAttribute(){
        return 'https://loremflickr.com/1280/980/hotel,modern/all?lock='.$this->id;
    }
    public function getFakePhotosAttribute(){
        return [
            'https://loremflickr.com/1280/980/hotel,modern/all?lock=1-'.$this->id,
            'https://loremflickr.com/1280/980/hotel,modern/all?lock=2-'.$this->id,
            'https://loremflickr.com/1280/980/hotel,modern/all?lock=3-'.$this->id,
            'https://loremflickr.com/1280/980/hotel,modern/all?lock=4-'.$this->id,
            'https://loremflickr.com/1280/980/hotel,modern/all?lock=5-'.$this->id,
        ];
    }
}
