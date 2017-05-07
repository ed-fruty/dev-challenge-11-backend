<?php

namespace App\Common\Vote\App\Http\Actions;


use App\Common\Vote\Concern\Traits\ClassificatorRepositoriesAware;
use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use App\Common\Vote\Contracts\Classificators\ClassificatorRepositoriesAwareInterface;

class GetVotersBlanks implements ClassificatorRepositoriesAwareInterface
{
    use ClassificatorRepositoriesAware;

    /**
     * @param $voter
     * @return \App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface[]
     */
    public function __invoke($voter)
    {
        return $this->voterRepository->findOrFail(new ClassificatorId($voter))->getBlanks();
    }
}