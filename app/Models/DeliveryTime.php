<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = ['curriculum_id', 'delivery_date'];

    public function curriculum() {
        return $this->belongsTo(Curriculums::class);
    }
}
