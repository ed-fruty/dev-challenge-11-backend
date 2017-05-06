<?php

namespace App\Common\Vote\Contracts\VoteBlank;


use App\Common\Vote\Concern\ValueObjects\VoteBlankId;

interface VoteBlankRepositoryInterface
{

    /**
     * @param VoteBlankId $id
     * @return VoteBlankInterface
     */
    public function findOrFail(VoteBlankId $id): VoteBlankInterface;

    /**
     * @return VoteBlankFactoryInterface
     */
    public function getVoteBlankFactory(): VoteBlankFactoryInterface;

    /**
     * @param VoteBlankInterface $blank
     * @return bool
     */
    public function save(VoteBlankInterface $blank): bool;
}