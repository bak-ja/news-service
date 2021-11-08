<?php

use Illuminate\Support\Facades\Route;


Route::get('/news', [\App\Http\Controllers\Api\News\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [\App\Http\Controllers\Api\News\NewsController::class, 'show'])->name('news.show');
Route::post('/news', [\App\Http\Controllers\Api\News\NewsController::class, 'store'])->name('news.store');
Route::post('/news/{id}/update', [\App\Http\Controllers\Api\News\NewsController::class, 'update'])->name('news.update');
Route::post('/news/{id}/publish', [\App\Http\Controllers\Api\News\NewsController::class, 'publish'])->name('news.publish');
Route::post('/news/{id}/unpublish', [\App\Http\Controllers\Api\News\NewsController::class, 'unpublish'])->name('news.unpublish');
Route::delete('/news/{id}', [\App\Http\Controllers\Api\News\NewsController::class, 'destroy'])->name('news.destroy');

