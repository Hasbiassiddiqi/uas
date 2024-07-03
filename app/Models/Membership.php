<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'membership';

    protected $fillable = [
        'user_id', 'points', 'total_purchases'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}