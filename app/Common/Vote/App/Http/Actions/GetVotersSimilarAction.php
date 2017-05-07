<?php

namespace App\Common\Vote\App\Http\Actions;


use App\Common\Vote\Concern\Traits\ClassificatorRepositoriesAware;
use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use App\Common\Vote\Contracts\Classificators\ClassificatorRepositoriesAwareInterface;

class GetVotersSimilarAction implements ClassificatorRepositoriesAwareInterface
{
    use ClassificatorRepositoriesAware;

    /**
     * @param $voter
     * @return array
     */
    public function __invoke($voter)
    {
        $voter = $this->voterRepository->findOrFail(new ClassificatorId($voter));

        $similar = [];


        foreach ($voter->getVotes() as $vote) {
            foreach ($vote->getBlanks() as $blank) {

            }
        }

        return $similar;
    }
}