<?php

namespace Modules\User\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class WebRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var Authenticatable
     */
    public Authenticatable $user;

    /**
     * Create a new event instance.
     *
     * @param Authenticatable $user
     * @return void
     */
    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }
}
