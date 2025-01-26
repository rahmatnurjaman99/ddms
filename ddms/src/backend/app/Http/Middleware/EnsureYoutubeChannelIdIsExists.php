<?php

namespace App\Http\Middleware;

use App\Enums\ResponseEnum;
use App\Models\YoutubeChannel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class EnsureYoutubeChannelIdIsExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    private static $ttl = 60 * 60;

    public function handle(Request $request, Closure $next): Response
    {
        $channelId = $request->route('channelId');
        $data = Cache::remember("channel-$channelId", self::$ttl, fn() => YoutubeChannel::where('channel_id', $channelId)->first());

        if(! $data){
            return ResponseEnum::NotFound->build(data: $data, message: 'Sorry, Channel ID not Found.');
        }

        return $next($request);
    }
}
