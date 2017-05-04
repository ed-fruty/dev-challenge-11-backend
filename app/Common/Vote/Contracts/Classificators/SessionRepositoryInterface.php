<?php
namespace App\Common\Vote\Contracts\Classificators;

interface SessionRepositoryInterface 
{
    /**
     * @param string $name
     * @return SessionInterface
     */
    public function findByNameOrCreate(string $name) : SessionInterface;
}