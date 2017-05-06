<?php

namespace App\Common\Vote\Contracts\Vote;

interface VoteRepositoryAwareInterface
{
    /**
     * @param VoteRepositoryInterface $voteRepository
     */
    public function setVoteRepository(VoteRepositoryInterface $voteRepository);
}
