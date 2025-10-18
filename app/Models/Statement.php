<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month',
        'total_meals',
        'total_market',
        'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}