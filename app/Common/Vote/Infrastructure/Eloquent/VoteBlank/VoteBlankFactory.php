<?php

namespace App\Common\Vote\Infrastructure\Eloquent\VoteBlank;


use App\Common\Vote\Contracts\VoteBlank\VoteBlankFactoryInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankWriteInterface;

class VoteBlankFactory implements VoteBlankFactoryInterface
{

    /**
     * @return VoteBlankInterface
     */
    public function createReadVoteBlank(): VoteBlankInterface
    {
        return new VoteBlank();
    }

    /**
     * @param VoteBlankInterface $blank
     * @return VoteBlankWriteInterface
     */
    public function createWriteVoteBlank(VoteBlankInterface $blank = null): VoteBlankWriteInterface
    {
        return new VoteBlankWrite($blank ?: $this->createReadVoteBlank());
    }
}