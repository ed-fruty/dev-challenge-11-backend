<?php

namespace App\Common\Vote\Contracts\Vote;


interface VoteFactoryInterface
{
    /**
     * @return VoteInterface
     */
    public function createReadVote(): VoteInterface;

    /**
     * @param VoteInterface|null $vote
     * @return VoteWriteInterface
     */
    public function createWriteVote(VoteInterface $vote = null): VoteWriteInterface;
}