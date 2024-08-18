<?php

use Illuminate\Support\Facades\Route;
use App\Models\Soldier;

Route::get('/test', function () {
    return $soldier = Soldier::pluck('date_of_end_of_service')->unique()->all();
    return $associativeArray = array_combine($soldier, $soldier);
    return $associativeArray;
});

Route::get('/', function () {
    return view('welcome');
});
