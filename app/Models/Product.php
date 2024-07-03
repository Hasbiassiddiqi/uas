<?php

namespace App\Models;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'hotel_id', 'type', 'price', 'available_room'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
