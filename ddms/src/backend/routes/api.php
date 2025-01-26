<?php

use App\Http\Controllers\API\YoutubeController;
use App\Http\Middleware\EnsureYoutubeChannelIdIsExists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('youtube')->as('youtube.')->group(function(){
    Route::prefix('channel')->as('channel.')->group(function(){
        Route::get('/', [YoutubeController::class, 'channel'])->name('show');
        Route::middleware(EnsureYoutubeChannelIdIsExists::class)->group(function(){
            Route::get('{channelId}/latest-videos', [YoutubeController::class, 'getLatestVideos'])->name('videos');
            Route::get('{channelId}/statistics', [YoutubeController::class, 'getChannelStatistics'])->name('statistics');
        });
    });
});
