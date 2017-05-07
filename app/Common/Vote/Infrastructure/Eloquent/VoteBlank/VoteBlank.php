<?php

namespace App\Common\Vote\Infrastructure\Eloquent\VoteBlank;


use App\Common\Vote\Concern\ValueObjects\Voice;
use App\Common\Vote\Concern\ValueObjects\VoteBlankId;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\Voter;
use App\Common\Vote\Infrastructure\Eloquent\Vote\Vote;
use Illuminate\Database\Eloquent\Model;

class VoteBlank extends Model implements VoteBlankInterface
{

    protected const ATTRIBUTE_VOTER = 'voter_id';
    protected const ATTRIBUTE_VOTE = 'vote_id';
    protected const ATTRIBUTE_VOICE = 'voice';

    protected const RELATION_VOTER = 'voter';
    protected const RELATION_VOTE = 'vote';

    protected $table = 'vote_blanks';

    /**
     * @var array
     */
    protected $with = [
        //'voter', 'vote'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'voter_id', 'vote_id'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'voice_value', 'voter_item', 'vote_item'
    ];

    /**
     * @return VoteBlankId
     */
    public function getId(): VoteBlankId
    {
        return new VoteBlankId($this->getKey());
    }

    /**
     * @return VoterInterface
     */
    public function getVoter(): VoterInterface
    {
        return $this->getAttribute(static::RELATION_VOTER);
    }

    /**
     * @return VoteInterface
     */
    public function getVote(): VoteInterface
    {
        return $this->getAttribute(static::RELATION_VOTE);
    }

    /**
     * @return Voice
     */
    public function getVoice(): Voice
    {
        return new Voice($this->getAttribute(static::ATTRIBUTE_VOICE));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vote()
    {
        return $this->belongsTo(Vote::class);
    }

    /**
     * @return string
     */
    public function getVoiceValueAttribute()
    {
        return $this->getVoice()->getName();
    }

    /**
     * @return VoterInterface
     */
    public function getVoterItemAttribute()
    {
        return $this->getVoter();
    }

    /**
     * @return VoteInterface
     */
    public function getVoteItemAttribute()
    {
        return $this->getVote();
    }
}