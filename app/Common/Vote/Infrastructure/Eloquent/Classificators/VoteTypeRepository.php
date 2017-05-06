<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Contracts\Classificators\VoteTypeInterface;
use App\Common\Vote\Contracts\Classificators\VoteTypeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class VoteTypeRepository implements VoteTypeRepositoryInterface
{
    /**
     * @var VoteType
     */
    private $model;

    /**
     * VoteTypeRepository constructor.
     * @param VoteType $model
     */
    public function __construct(VoteType $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $name
     * @return VoteTypeInterface|Model
     */
    public function findByNameOrCreate(string $name): VoteTypeInterface
    {
        return $this->model->newQuery()->firstOrCreate(compact('name'));
    }
}