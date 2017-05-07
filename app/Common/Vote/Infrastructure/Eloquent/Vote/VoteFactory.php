<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Vote;


use App\Common\Vote\Contracts\Vote\VoteFactoryInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\Vote\VoteWriteInterface;

class VoteFactory implements VoteFactoryInterface
{

    /**
     * @return VoteInterface
     */
    public function createReadVote(): VoteInterface
    {
        return new Vote();
    }

    /**
     * @param VoteInterface|null $vote
     * @return VoteWriteInterface
     */
    public function createWriteVote(VoteInterface $vote = null): VoteWriteInterface
    {
        return new VoteWrite($vote ?: $this->createReadVote());
    }
}