<?php

use Illuminate\Support\Facades\Route;

use Rudestewing\ActivityLogger\Http\Controllers\ActivityLogController;

Route::get('activity-logs', [ActivityLogController::class, 'index']);
Route::get('activity-logs/fetch/data', [ActivityLogController::class, 'fetchData']);