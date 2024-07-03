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
    public function addPoints($transactionDetails)
    {
        $points = 0;
        foreach ($transactionDetails as $detail) {
            if (in_array($detail->product->type, ['Deluxe', 'Superior', 'Suite'])) {
                $points += 5 * $detail->quantity;
            } else {
                $points += floor($detail->price * $detail->quantity / 300000);
            }
        }
        $this->points += $points;
        $this->save();
    }
}