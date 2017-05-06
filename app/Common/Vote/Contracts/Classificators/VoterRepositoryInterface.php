<?php
namespace App\Common\Vote\Contracts\Classificators;

use App\Common\Vote\Concern\ValueObjects\ClassificatorId;

interface VoterRepositoryInterface
{
    /**
     * @param ClassificatorId $id
     * @return VoterInterface
     */
    public function findOrFail(ClassificatorId $id): VoterInterface;

    /**
     * @param string $name
     * @return VoterInterface
     */
    public function findByNameOrCreate(string $name): VoterInterface;
}