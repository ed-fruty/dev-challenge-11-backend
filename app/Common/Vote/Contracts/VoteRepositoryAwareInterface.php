<?php

namespace App\Common\Vote\Contracts;

interface VoteRepositoryAwareInterface
{
    /**
     * @param VoteRepositoryInterface $voteRepository
     */
    public function setVoteRepository(VoteRepositoryInterface $voteRepository);
}
