<?php

namespace App\Services;

use App\Contracts\YoutubeServiceContract;
use App\Enums\ResponseEnum;
use Illuminate\Support\Facades\Log;

class YoutubeV3Service implements YoutubeServiceContract
{
    public static function setupCredential($apiKey = null): \Google\Service\YouTube
    {
        $apiKey = $apiKey ?? config('services.google.api_key');
        $client = new \Google\Client();
        $client->setDeveloperKey($apiKey);

        try {
            return new \Google\Service\YouTube($client);
        } catch (\Throwable $th) {
            Log::error('failed setup credential', [$th]);
            return ResponseEnum::Fatal->build(message: 'Sorry, something gone wrong, we will check it ASAP.');
        }
    }

    public static function getLatestVideos(array $params): array
    {
        $youtube = self::setupCredential();

        $channelId = $params['channel_id'] ?? null;
        $maxResult = $params['max_result'] ?? 1;
        $requestParams = [
            'channelId' => $channelId,
            'maxResults' => $maxResult,
            'order' => 'date',
            'type' => 'video'
        ];

        try {
            $response = $youtube->search->listSearch(part: 'snippet', optParams: $requestParams);
        } catch (\Throwable $th) {
            Log::error('failed get latest videos', [$th]);
            return ResponseEnum::Fatal->build(message: 'Sorry, something gone wrong, we will check it ASAP.');
        }

        return $response['items'];
    }

    public static function getVideoStatistics(array $params): array
    {
        $youtube = self::setupCredential();

        $channelId = $params['channel_id'] ?? null;
        $requestParams = [
            'id' => $channelId
        ];

        try {
            $response = $youtube->channels->listChannels(part: 'snippet,statistics', optParams: $requestParams);
        } catch (\Throwable $th) {
            Log::error('failed get video statistics', [$th]);
            return ResponseEnum::Fatal->build(message: 'Sorry, something gone wrong, we will check it ASAP.');
        }

        return $response['items'];
    }
}
