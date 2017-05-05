<?php

namespace App\Common\Document\Concern\ValueObjects;

class ParsedVoteCollection
{
    /**
     * @var ParsedVote[]
     */
    private $votes;

    /**
     * ParsedVoteCollection constructor.
     * @param array $votes
     */
    public function __construct(array $votes)
    {
        $this->votes = $votes;
    }

    /**
     * @return ParsedVote[]
     */
    public function all()
    {
        return $this->votes;
    }
}
