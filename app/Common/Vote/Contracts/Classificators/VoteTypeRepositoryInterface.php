<?php
namespace App\Common\Vote\Contracts\Classificators;

interface VoteTypeRepositoryInterface 
{
    /**
     * @param string $name
     * @return VoteTypeInterface
     */
    public function findByNameOrCreate(string $name) : VoteTypeInterface;
}