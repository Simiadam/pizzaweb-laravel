<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return '<a>hello</a>';
});

Route::get('/', function () {
    return view('app');
});
