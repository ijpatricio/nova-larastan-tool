<?php

use Ijpatricio\NovaLarastanTool\Http\Controllers\AnalysisReportController;
use Ijpatricio\NovaLarastanTool\Http\Controllers\FileIntervalContentController;
use Ijpatricio\NovaLarastanTool\Http\Controllers\LarastanCheckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/analysis-report', AnalysisReportController::class . '@show');
Route::get('/larastan-check', LarastanCheckController::class . '@show');
Route::get('/file-contents', FileIntervalContentController::class . '@show');
