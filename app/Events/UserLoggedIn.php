<?php namespace App\Events;

class UserLoggedIn extends Event
{
    /**
     * Identifier of the logged in user
     *
     * @var int
     */
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @param int $user_id the primary key of the user who was just authenticated.
     *
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
}