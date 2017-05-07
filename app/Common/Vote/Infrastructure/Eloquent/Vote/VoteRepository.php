<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Vote;


use App\Common\Vote\Concern\ValueObjects\VoteId;
use App\Common\Vote\Contracts\Vote\VoteFactoryInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\Vote\VoteRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VoteRepository implements VoteRepositoryInterface
{
    /**
     * @var Vote
     */
    private $model;

    /**
     * VoteRepository constructor.
     * @param Vote $model
     */
    public function __construct(Vote $model)
    {
        $this->model = $model;
    }

    /**
     * @param VoteId $id
     * @return VoteInterface|Model
     * @throws ModelNotFoundException
     */
    public function findOrFail(VoteId $id): VoteInterface
    {
        return $this->model->newQuery()->findOrFail($id->getValue());
    }

    /**
     * @param VoteInterface $vote
     * @return bool
     */
    public function save(VoteInterface $vote): bool
    {
        /** @var Vote $vote */
        return (bool) $vote->save();
    }

    /**
     * @return VoteFactoryInterface
     */
    public function getVoteFactory(): VoteFactoryInterface
    {
        return new VoteFactory();
    }
}