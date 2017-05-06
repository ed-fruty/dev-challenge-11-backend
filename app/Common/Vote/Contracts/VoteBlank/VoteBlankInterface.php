<?php

namespace App\Common\Vote\Contracts\VoteBlank;


use App\Common\Vote\Concern\ValueObjects\VoteBlankId;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;

interface VoteBlankInterface
{
    /**
     * @return VoteBlankId
     */
    public function getId(): VoteBlankId;

    /**
     * @return VoterInterface
     */
    public function getVoter(): VoterInterface;

    /**
     * @return VoteInterface
     */
    public function getVote(): VoteInterface;

    /**
     * @return Voice
     */
    public function getVoice() : Voice;
}