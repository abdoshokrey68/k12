<?php

namespace App\Models;

use App\Casts\VicationsColumnsTranslateCasts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vications extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'type' => VicationsColumnsTranslateCasts::class
    ];

    public function soldier () {
        return $this->belongsTo(Soldier::class);
    }
}
