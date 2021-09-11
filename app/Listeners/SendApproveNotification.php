<?php

namespace App\Listeners;

use App\Events\PostStore;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendApproveNotification
{

    /**
     * Handle the event.
     *
     * @param  PostStore  $event
     * @return void
     */
    public function handle(PostStore $event)
    {
        $event->user->sendEmailApprove($event->post);
    }
}
