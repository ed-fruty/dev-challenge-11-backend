<?php

namespace App\Common\Vote\Concern\Traits;

use App\Common\Vote\Contracts\VoteRepositoryInterface;

trait VoteRepositoryAware
{
    /**
     * @var VoteRepositoryInterface
     */
    protected $voteRepository;

    /**
     * @param VoteRepositoryInterface $voteRepository
     */
    public function setVoteRepository(VoteRepositoryInterface $voteRepository)
    {
        $this->voteRepository = $voteRepository;
    }
}
