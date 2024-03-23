<?php

namespace App\Listeners;

use App\Repositories\UserRepository;

class UpdateUserVerification
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
        app(UserRepository::class)
            ->setModel($event->user)
            ->setVerificationTime(now());
    }
}
