<?php

namespace App\Common\Vote\Contracts\VoteBlank;


use App\Common\Vote\Concern\ValueObjects\Voice;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;

interface VoteBlankWriteInterface
{
    /**
     * @param VoterInterface $voter
     * @return VoteBlankWriteInterface
     */
    public function setVoter(VoterInterface $voter): VoteBlankWriteInterface;

    /**
     * @param VoteInterface $vote
     * @return VoteBlankWriteInterface
     */
    public function setVote(VoteInterface $vote): VoteBlankWriteInterface;

    /**
     * @param Voice $voice
     * @return VoteBlankWriteInterface
     */
    public function setVoice(Voice $voice): VoteBlankWriteInterface;

    /**
     * @return VoteBlankInterface
     */
    public function getReadVoteBlank(): VoteBlankInterface;
}