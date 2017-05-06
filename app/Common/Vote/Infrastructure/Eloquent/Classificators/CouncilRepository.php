<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Contracts\Classificators\CouncilInterface;
use App\Common\Vote\Contracts\Classificators\CouncilRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CouncilRepository implements CouncilRepositoryInterface
{

    /**
     * @var Council
     */
    private $model;

    /**
     * CouncilRepository constructor.
     * @param Council $model
     */
    public function __construct(Council $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $name
     * @return CouncilInterface|Model
     */
    public function findByNameOrCreate(string $name): CouncilInterface
    {
        return $this->model->newQuery()->firstOrCreate(compact('name'));
    }
}