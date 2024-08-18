<?php

namespace App\Models;

use App\Casts\SoldiersColumnsTranslateCasts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\PhotoCasting;
class Soldier extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        // 'photo'     => PhotoCasting::class,
        // 'rank'     => SoldiersColumnsTranslateCasts::class,
        // 'marital_status'     => SoldiersColumnsTranslateCasts::class,
    ];

    public function vications () {
        return $this->hasMany(Vications::class);
    }

    public function penalties () {
        return $this->hasMany(Penalty::class);
    }

    public function recruitment () {
        return $this->belongsTo(Recruitment::class);
    }

    public function point () {
        return $this->belongsTo(Point::class);
    }
}
