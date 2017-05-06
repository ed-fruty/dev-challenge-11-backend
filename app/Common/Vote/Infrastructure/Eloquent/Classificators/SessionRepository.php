<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Contracts\Classificators\SessionInterface;
use App\Common\Vote\Contracts\Classificators\SessionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SessionRepository implements SessionRepositoryInterface
{

    /**
     * @var Session
     */
    private $model;

    /**
     * SessionRepository constructor.
     * @param Session $model
     */
    public function __construct(Session $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $name
     * @return SessionInterface|Model
     */
    public function findByNameOrCreate(string $name): SessionInterface
    {
        return $this->model->newQuery()->firstOrCreate(compact('name'));
    }
}