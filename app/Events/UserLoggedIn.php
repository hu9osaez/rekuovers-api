<?php namespace App\Events;

class UserLoggedIn extends Event
{
    /**
     * Identifier of the signed in user
     *
     * @var int
     */
    public $userId;

    /**
     * Create a new event instance.
     *
     * @param int $userId the primary key of the user who was just authenticated.
     *
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}
