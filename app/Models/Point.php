<?php

namespace App\Models;

use App\Casts\PointsStatments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'statments' => PointsStatments::class
    ];
}
