<?php

namespace App\Services;

use App\Contracts\YoutubeServiceContract;

class YoutubeService
{
    public static function getLatestVideos(YoutubeServiceContract $youtubeService, array $params): array
    {
        return $youtubeService::getLatestVideos(params: $params);
    }

    public static function getVideoStatistics(YoutubeServiceContract $youtubeService, array $params): array
    {
        return $youtubeService::getVideoStatistics(params: $params);
    }
}
