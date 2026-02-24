<?php

namespace App\Listeners;

use App\Events\BlogUpdated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CacheBlogUpdated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BlogUpdated $event): void
    {
        $cacheKey = "blog-{$event->blog->id}";
        Cache::put($cacheKey, $event->blog, 60);
    }
}
