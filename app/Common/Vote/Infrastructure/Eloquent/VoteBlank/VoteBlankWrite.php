<?php

namespace App\Common\Vote\Infrastructure\Eloquent\VoteBlank;


use App\Common\Vote\Concern\ValueObjects\Voice;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankWriteInterface;

class VoteBlankWrite extends VoteBlank implements VoteBlankWriteInterface
{
    /**
     * @var VoteBlank
     */
    private $blank;

    /**
     * VoteBlankWrite constructor.
     * @param VoteBlank $blank
     * @param array $attributes
     */
    public function __construct(VoteBlank $blank, array $attributes = [])
    {
        parent::__construct($attributes);

        $this->blank = $blank;
    }

    /**
     * @param VoterInterface $voter
     * @return VoteBlankWriteInterface
     */
    public function setVoter(VoterInterface $voter): VoteBlankWriteInterface
    {
        $this->blank->voter()->associate($voter);

        return $this;
    }

    /**
     * @param VoteInterface $vote
     * @return VoteBlankWriteInterface
     */
    public function setVote(VoteInterface $vote): VoteBlankWriteInterface
    {
        $this->blank->vote()->associate($vote);

        return $this;
    }

    /**
     * @param Voice $voice
     * @return VoteBlankWriteInterface
     */
    public function setVoice(Voice $voice): VoteBlankWriteInterface
    {
        $this->blank->setAttribute(static::ATTRIBUTE_VOICE, $voice->getValue());

        return $this;
    }

    /**
     * @return VoteBlankInterface
     */
    public function getReadVoteBlank(): VoteBlankInterface
    {
        return $this->blank;
    }
}