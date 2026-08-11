<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware("auth")->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get("/clocks", "clocks")->name("clocks");
    });
});
