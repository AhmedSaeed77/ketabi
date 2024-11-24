<?php

use Illuminate\Support\Facades\Route;


Route::any('{anything?}', function () {
    return response()->json([
        'message' => 'Not supported platform',
    ]);
});
