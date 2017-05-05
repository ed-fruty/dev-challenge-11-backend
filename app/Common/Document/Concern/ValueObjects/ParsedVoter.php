<?php

namespace App\Common\Document\Concern\ValueObjects;

class ParsedVoter
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $vote;

    /**
     * ParsedVoter constructor.
     * @param $name
     * @param $vote
     */
    public function __construct(string $name, string $vote)
    {
        $this->name = $name;
        $this->vote = $vote;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVote(): string
    {
        return $this->vote;
    }
}
