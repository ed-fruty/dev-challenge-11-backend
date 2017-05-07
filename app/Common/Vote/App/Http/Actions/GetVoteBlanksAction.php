<?php

namespace App\Common\Vote\App\Http\Actions;


use App\Common\Vote\Concern\Traits\VoteRepositoryAware;
use App\Common\Vote\Concern\ValueObjects\VoteId;
use App\Common\Vote\Contracts\Vote\VoteRepositoryAwareInterface;

class GetVoteBlanksAction implements VoteRepositoryAwareInterface
{
    use VoteRepositoryAware;

    /**
     * @param $vote
     * @return \App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface[]
     */
    public function __invoke($vote)
    {
        return $this->voteRepository->findOrFail(new VoteId($vote))->getBlanks();
    }
}