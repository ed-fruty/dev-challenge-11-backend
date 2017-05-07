<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Classificators\VoterRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VoterRepository implements VoterRepositoryInterface
{

    /**
     * @var Voter
     */
    private $model;

    /**
     * VoterRepository constructor.
     * @param Voter $model
     */
    public function __construct(Voter $model)
    {
        $this->model = $model;
    }

    /**
     * @param ClassificatorId $id
     * @return VoterInterface|Model
     */
    public function findOrFail(ClassificatorId $id): VoterInterface
    {
        return $this->model->newQuery()->findOrFail($id->getValue());
    }

    /**
     * @param string $name
     * @return VoterInterface|Model
     */
    public function findByNameOrCreate(string $name): VoterInterface
    {
        return $this->model->newQuery()->firstOrCreate(compact('name'));
    }

    /**
     * @param string $name
     * @return VoterInterface
     */
    public function findByName(string $name)
    {
        return $this->model->newQuery()->where('name', $name)->first();
    }

    /**
     * @return VoterInterface[]|Collection
     */
    public function all()
    {
        return $this->model->newQuery()->get();
    }
}