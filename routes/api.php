<?php

use Illuminate\Support\Facades\Route;

// Contoh route API sederhana (boleh dibiarkan saja)
Route::get('/ping', function () {
    return response()->json(['message' => 'API OK']);
});
