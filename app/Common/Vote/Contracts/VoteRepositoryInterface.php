<?php

namespace App\Common\Vote\Contracts;

use App\Common\Vote\Concern\ValueObjects\VoteId;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface VoteRepositoryInterface
{
    /**
     * @param VoteId $id
     * @return VoteInterface
     * @throws ModelNotFoundException
     */
    public function findOrFail(VoteId $id): VoteInterface;

    /**
     * @param VoteInterface $vote
     * @return bool
     */
    public function save(VoteInterface $vote): bool;
}
