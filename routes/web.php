<?php

use App\LosData;
use Illuminate\Support\Facades\Route;

Route::get('/data', function () {
    return LosData::all();
});
