<?php

namespace App\Common\Vote\Concern\Events;


use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;

class VoteBlankWasCreatedEvent
{
    /**
     * @var VoteBlankInterface
     */
    private $blank;

    /**
     * VoteBlankWasCreatedEvent constructor.
     * @param VoteBlankInterface $blank
     */
    public function __construct(VoteBlankInterface $blank)
    {
        $this->blank = $blank;
    }

    /**
     * @return VoteBlankInterface
     */
    public function getBlank(): VoteBlankInterface
    {
        return $this->blank;
    }
}