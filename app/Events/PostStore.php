<?php

namespace App\Events;

use App\Models\Post;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostStore
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The authenticated user.
     *
     * @var User
     */
    public $user;
    /**
     * @var Post
     */
    public $post;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Post $post
     */
    public function __construct(User $user,Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

}
