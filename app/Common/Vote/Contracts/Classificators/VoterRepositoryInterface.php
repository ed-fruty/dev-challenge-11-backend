<?php
namespace App\Common\Vote\Contracts\Classificators;

interface VoterRepositoryInterface
{
    /**
     * @param string $name
     * @return VoterInterface
     */
    public function findByNameOrCreate(string $name) : VoterInterface;
}