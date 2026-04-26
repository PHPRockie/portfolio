<?php

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/projects', [PageController::class, 'projects']);
Route::get('/projects/{slug}', [PageController::class, 'show'])->name('projects.show');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'send'])->name('contact.send');

