<?php

use App\LosDataKbdb;
use App\LosDataDuivenspel;
use Illuminate\Support\Facades\Route;

Route::get('/data-kbdb', function () {
    return LosDataKbdb::get()->makeHidden(['id', 'created_at', 'updated_at']);
});

Route::get('/data-duivenspel', function () {
    return LosDataDuivenspel::get()->makeHidden(['id', 'created_at', 'updated_at']);
});

Route::get('/testtable', function () {
    return view('testTable');
});
