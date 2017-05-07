<?php

namespace App\Common\Vote\App\Http\Actions;


use App\Common\Vote\Concern\Traits\ClassificatorRepositoriesAware;
use App\Common\Vote\Contracts\Classificators\ClassificatorRepositoriesAwareInterface;

class GetVotersAction implements ClassificatorRepositoriesAwareInterface
{
    use ClassificatorRepositoriesAware;

    /**
     * @return \App\Common\Vote\Contracts\Classificators\VoterInterface[]|\Illuminate\Database\Eloquent\Collection
     */
    public function __invoke()
    {
        return $this->voterRepository->all();
    }
}