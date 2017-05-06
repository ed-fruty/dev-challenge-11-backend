<?php

namespace App\Common\Vote\Concern\Traits;


use App\Common\Vote\Contracts\VoteBlank\VoteBlankRepositoryInterface;

trait VoteBlankRepositoryAware
{
    /**
     * @var VoteBlankRepositoryInterface
     */
    protected $voteBlankRepository;

    /**
     * @param VoteBlankRepositoryInterface $voteBlankRepository
     */
    public function setVoteBlankRepository(VoteBlankRepositoryInterface $voteBlankRepository)
    {
        $this->voteBlankRepository = $voteBlankRepository;
    }
}