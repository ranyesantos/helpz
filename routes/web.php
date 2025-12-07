<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/test-log', function () {
    Log::debug('log custom debug');
    Log::info('log info');
    Log::warning('log warning');
    Log::error('log error');

    return 'ok';
});
