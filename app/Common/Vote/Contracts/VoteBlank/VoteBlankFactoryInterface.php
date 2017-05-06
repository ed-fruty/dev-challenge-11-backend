<?php

namespace App\Common\Vote\Contracts\VoteBlank;


interface VoteBlankFactoryInterface
{
    /**
     * @return VoteBlankInterface
     */
    public function createReadVoteBlank(): VoteBlankInterface;

    /**
     * @param VoteBlankInterface $blank
     * @return VoteBlankWriteInterface
     */
    public function createWriteVoteBlank(VoteBlankInterface $blank = null): VoteBlankWriteInterface;
}