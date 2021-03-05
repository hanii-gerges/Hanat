<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countdown extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'finishTime',
    ];

    function user()
    {
        return $this-> belongsTo(User::class);
    }
}
