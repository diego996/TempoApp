<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'call_count',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
