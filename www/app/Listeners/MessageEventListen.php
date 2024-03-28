<?php

namespace App\Listeners;

use App\Events\MessageEvent;
use App\Models\Message;

class MessageEventListen
{
    /**
     * Create the event listener.
     */
    public function __construct(string $message)
    {
        Message::add(['text'=>$message, 'is_read'=>0]);
    }

    /**
     * Handle the event.
     */
    public function handle(MessageEvent $event): void
    {

    }
}
