<?php

use App\LosDataDuivenspel;
use App\LosDataKbdb;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/data-kbdb', function () {
    return LosDataKbdb::get()->makeHidden(['id', 'created_at', 'updated_at']);
});

Route::get('/data-duivenspel', function () {
    return LosDataDuivenspel::get()->makeHidden(['id', 'created_at', 'updated_at']);
});

Route::get('/testtable', function () {
    return view('testTable');
});

Route::get('/kbdb/table/{table}', 'KBDBTableController@show')->name('table.show');
