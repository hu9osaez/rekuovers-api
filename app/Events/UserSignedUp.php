<?php namespace App\Events;

class UserSignedUp extends Event
{
    /**
     * Identifier of the signed up user
     *
     * @var int
     */
    public $userId;

    /**
     * Create a new event instance.
     *
     * @param int $userId the primary key of the user who was just created.
     *
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}