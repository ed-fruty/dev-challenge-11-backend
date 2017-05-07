<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Classificators;


use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use App\Common\Vote\Infrastructure\Eloquent\Vote\Vote;
use App\Common\Vote\Infrastructure\Eloquent\VoteBlank\VoteBlank;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model implements VoterInterface
{
    /**
     * @var string
     */
    protected $table = 'voters';

    /**
     * @var array
     */
    protected $fillable = ['name'];

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
        return $this->getAttribute('blanks');
    }

    /**
     * @return VoteInterface[]
     */
    public function getVotes()
    {
        /** @var Collection $blanks */
        $blanks = $this->getBlanks();

        return $blanks->map(function(VoteBlank $blank) {
            return $blank->getVote();
        });
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