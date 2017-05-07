<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use App\Common\Vote\Infrastructure\Eloquent\Vote\Vote;
use App\Common\Vote\Infrastructure\Eloquent\VoteBlank\VoteBlank;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model implements VoterInterface
{

    /**
     * @return ClassificatorId
     */
    public function getId(): ClassificatorId
    {
        return new ClassificatorId($this->getKey());
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    /**
     * @return VoteBlankInterface[]
     */
    public function getBlanks()
    {
        return $this->getRelation('blanks');
    }

    /**
     * @return VoteInterface[]
     */
    public function getVotes()
    {
        return $this->getRelation('votes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blanks()
    {
        return $this->hasMany(VoteBlank::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function votes()
    {
        return $this->hasManyThrough(Vote::class, VoteBlank::class);
    }
}