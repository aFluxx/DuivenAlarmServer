<?php

use App\LosData;
use Illuminate\Support\Facades\Route;

Route::get('/data', function () {
    return LosData::get()->makeHidden(['id', 'created_at', 'updated_at']);
});

Auth::routes(['register' => false]);
