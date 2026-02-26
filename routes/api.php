<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\DeploymentChecksController;
use Illuminate\Support\Facades\Route;

// Projects routes
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectsController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}/readiness', [ProjectsController::class, 'readiness'])->name('projects.readiness');
Route::post('/projects/{project}/checks', [ProjectsController::class, 'addCheck'])->name('projects.checks.store');

// Deployment Checks routes
Route::patch('/checks/{check}/complete', [DeploymentChecksController::class, 'complete'])->name('checks.complete');
