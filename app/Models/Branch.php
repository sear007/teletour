<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = array('feature_image', 'photos');
    public function rooms(){
        return $this->hasMany(RoomType::class);
    }

    public function scopeActiveRooms($query)
    {
        return $query->whereBranchTypeId(1)
            ->whereIsActive(1)
            ->whereHas('rooms')
            ->with('location')
            ->with('rooms', function ($query) {
                $query->where('is_active', 1);
            });
    }

    public function getPhotosAttribute(){
        $path = 'https://teleupload.utebi.com/public/branch_photo/';
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
        $path = 'https://teleupload.utebi.com/public/branch_photo/';
        return $path.$this->photo;
    }

    public function location() {
        return $this->belongsTo(Location::class, 'province_id');
    }

}
