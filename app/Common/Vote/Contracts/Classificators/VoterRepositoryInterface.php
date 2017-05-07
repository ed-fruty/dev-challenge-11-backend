<?php
namespace App\Common\Vote\Contracts\Classificators;

use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param string $name
     * @return VoterInterface
     */
    public function findByName(string $name);

    /**
     * @return VoterInterface[]|Collection
     */
    public function all();
}