<?php

namespace App\Common\Vote\Concern\Events;


use App\Common\Vote\Contracts\Vote\VoteInterface;

class VoteWasCreatedEvent
{
    /**
     * @var VoteInterface
     */
    private $vote;

    /**
     * VoteWasCreatedEvent constructor.
     * @param VoteInterface $vote
     */
    public function __construct(VoteInterface $vote)
    {
        $this->vote = $vote;
    }

    /**
     * @return VoteInterface
     */
    public function getVote(): VoteInterface
    {
        return $this->vote;
    }
}