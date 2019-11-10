<?php

namespace App\Listeners;

use App\Events\MatchStatsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MatchStatsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MatchStatsEvent  $event
     * @return void
     */
    public function handle(MatchStatsEvent $event)
    {
        //
    }
}
