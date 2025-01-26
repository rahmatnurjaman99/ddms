<?php

namespace App\Http\Controllers\API;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Models\YoutubeChannel;
use App\Services\YoutubeService;
use App\Services\YoutubeV3Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class YoutubeController extends Controller
{
    private static $ttl = 60 * 60;

    public function channel(Request $request): JsonResponse
    {
        $channelId = $request->channel_id;
        $data = Cache::remember("channel-$channelId", static::$ttl, fn() => YoutubeChannel::where('channel_id', $channelId)->first());

        if(! $data){
            return ResponseEnum::NotFound->build(data: $data, message: 'Sorry, Channel ID not Found.');
        }

        return ResponseEnum::Success->build(data: $data);
    }

    public function getLatestVideos(Request $request, $channelId): JsonResponse
    {
        $maxResult = $request->max_result ?? 2;
        $responseVideos = YoutubeService::getLatestVideos(new YoutubeV3Service, ['channel_id' => $channelId, 'max_result' => $maxResult]);

        $videos = [];
        foreach ($responseVideos as $video) {
            $videos[] = [
                'title' => $video['snippet']['title'],
                'published_at' => $video['snippet']['publishedAt'],
                'url' => sprintf("https://www.youtube.com/watch?v=%s", $video['id']['videoId']),
                'thumbnail' => $video['snippet']['thumbnails']['default']['url']
            ];
        }


        return ResponseEnum::Success->build(['videos' => $videos]);
    }

    public function getChannelStatistics($channelId)
    {
        $responseStatistics = YoutubeService::getVideoStatistics(new YoutubeV3Service, ['channel_id' => $channelId]);

        $informations = [
            'channel' => [
                'id' => $responseStatistics[0]['id'],
                'name' => $responseStatistics[0]['snippet']['title'],
                'url' => sprintf("https://youtube.com/%s", $responseStatistics[0]['snippet']['customUrl']),
            ],
            'statistics' => [
                'subscribers_count' => (int) $responseStatistics[0]['statistics']['subscriberCount'],
                'views_count' => (int) $responseStatistics[0]['statistics']['viewCount'],
                'videos_count' => (int) $responseStatistics[0]['statistics']['videoCount'],
            ],
        ];


        return ResponseEnum::Success->build(data: $informations, message: 'Fetching data successfully');
    }
}
