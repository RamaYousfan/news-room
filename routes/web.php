<?php

use Illuminate\Support\Facades\Route;

use App\Jobs\TestJob;

Route::get('/test', function () {

    TestJob::dispatch();

    return 'Job sent';
});

Route::get('/', function () {
    return view('welcome');
});
