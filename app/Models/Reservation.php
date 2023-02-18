<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = [];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function roomType(){
        return $this->belongsTo(RoomType::class);
    }
}
