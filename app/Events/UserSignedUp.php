<?php namespace App\Events;

class UserSignedUp extends Event
{
    /**
     * Identifier of the signed up user
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $user
     *
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
