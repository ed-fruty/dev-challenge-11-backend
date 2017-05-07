<?php

namespace App\Common\Vote\Infrastructure\Eloquent\VoteBlank;


use App\Common\Vote\Concern\ValueObjects\VoteBlankId;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankFactoryInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class VoteBlankRepository implements VoteBlankRepositoryInterface
{

    /**
     * @var VoteBlank
     */
    private $model;

    /**
     * VoteBlankRepository constructor.
     * @param VoteBlank $model
     */
    public function __construct(VoteBlank $model)
    {
        $this->model = $model;
    }

    /**
     * @param VoteBlankId $id
     * @return VoteBlankInterface|Model
     */
    public function findOrFail(VoteBlankId $id): VoteBlankInterface
    {
        return $this->model->newQuery()->findOrFail($id->getValue());
    }

    /**
     * @return VoteBlankFactoryInterface
     */
    public function getVoteBlankFactory(): VoteBlankFactoryInterface
    {
        return new VoteBlankFactory();
    }

    /**
     * @param VoteBlankInterface $blank
     * @return bool
     */
    public function save(VoteBlankInterface $blank): bool
    {
        /** @var VoteBlank $blank */
        return (bool) $blank->save();
    }
}