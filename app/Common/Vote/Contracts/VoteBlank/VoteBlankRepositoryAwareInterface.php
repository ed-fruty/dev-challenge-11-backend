<?php

namespace App\Common\Vote\Contracts\VoteBlank;


interface VoteBlankRepositoryAwareInterface
{
    /**
     * @param VoteBlankRepositoryInterface $voteBlankRepository
     */
    public function setVoteBlankRepository(VoteBlankRepositoryInterface $voteBlankRepository);
}