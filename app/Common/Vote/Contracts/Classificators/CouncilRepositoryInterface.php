<?php
namespace App\Common\Vote\Contracts\Classificators;

interface CouncilRepositoryInterface 
{
    /**
     * @param string $name
     * @return CouncilInterface
     */
    public function findByNameOrCreate(string $name) : CouncilInterface;
}