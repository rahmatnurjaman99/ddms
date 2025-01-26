<?php

namespace App\Contracts;

interface YoutubeServiceContract {
    public static function setupCredential(string $apiKey): \Google\Service\YouTube;
    public static function getLatestVideos(array $params): array;
    public static function getVideoStatistics(array $params): array;
}
