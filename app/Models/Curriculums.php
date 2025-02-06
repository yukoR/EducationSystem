<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculums extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'video_url',
        'alway_delivery_flg',
        'grade_id'
    ];

    public function deliveryTimes() {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    public function grades() {
        return $this->belongsTo(Grades::class, 'grade_id');
    }   
}
