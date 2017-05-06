<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Contracts\Classificators\ConvocationInterface;
use App\Common\Vote\Contracts\Classificators\ConvocationRepositoryInterface;

class ConvocationRepository implements ConvocationRepositoryInterface
{

    /**
     * @var Convocation
     */
    private $model;

    /**
     * ConvocationRepository constructor.
     * @param Convocation $model
     */
    public function __construct(Convocation $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $name
     * @return ConvocationInterface
     */
    public function findByNameOrCreate(string $name): ConvocationInterface
    {
        /** @var ConvocationInterface|Convocation  $convocation */
        $convocation = $this->model->newQuery()->firstOrCreate(compact('name'));

        return $convocation;
    }
}