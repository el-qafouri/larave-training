<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserByToken implements ShouldQueue
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
    public function handle(object $event): void
    {
        //send token to user
    }
}
