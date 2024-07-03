<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'phone', 'email', 'rating', 'type', 'image_url'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}