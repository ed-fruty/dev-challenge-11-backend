<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Vote;


use App\Common\Vote\Concern\ValueObjects\VoteId;
use App\Common\Vote\Contracts\Classificators\ConvocationInterface;
use App\Common\Vote\Contracts\Classificators\CouncilInterface;
use App\Common\Vote\Contracts\Classificators\SessionInterface;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Classificators\VoteTypeInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\Convocation;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\Council;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\Session;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\Voter;
use App\Common\Vote\Infrastructure\Eloquent\Classificators\VoteType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model implements VoteInterface
{

    protected const ATTRIBUTE_TOPIC = 'topic';
    protected const ATTRIBUTE_NUMBER = 'number';
    protected const ATTRIBUTE_DATE = 'date';
    protected const ATTRIBUTE_APPROVED_AMOUNT = 'approved_amount';
    protected const ATTRIBUTE_DECLINED_AMOUNT = 'declined_amount';
    protected const ATTRIBUTE_ABSTAINED_AMOUNT = 'abstained_amount';
    protected const ATTRIBUTE_NOT_VOTED_AMOUNT = 'not_voted_amount';
    protected const ATTRIBUTE_MISSED_AMOUNT = 'missed_amount';
    protected const ATTRIBUTE_DECISION = 'decision';

    protected const RELATION_COUNCIL = 'council';
    protected const RELATION_SESSION = 'session';
    protected const RELATION_CONVOCATION = 'convocation';
    protected const RELATION_TYPE = 'type';
    protected const RELATION_VOTERS = 'voters';
    protected const RELATION_BLANKS = 'blanks';

    /**
     * @var string
     */
    protected $table = 'votes';

    /**
     * @return VoteId
     */
    public function getId(): VoteId
    {
        return new VoteId($this->getKey());
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->getAttribute(static::ATTRIBUTE_TOPIC);
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return (int) $this->getAttribute(static::ATTRIBUTE_NUMBER);
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return Carbon::createFromFormat('Y-m-d', $this->getAttribute(static::ATTRIBUTE_DATE));
    }

    /**
     * @return int
     */
    public function getApprovedAmount(): int
    {
        return (int) $this->getAttribute(static::ATTRIBUTE_APPROVED_AMOUNT);
    }

    /**
     * @return int
     */
    public function getDeclinedAmount(): int
    {
        return (int) $this->getAttribute(static::ATTRIBUTE_DECLINED_AMOUNT);
    }

    /**
     * @return int
     */
    public function getAbstainedAmount(): int
    {
        return (int) $this->getAttribute(static::ATTRIBUTE_ABSTAINED_AMOUNT);
    }

    /**
     * @return int
     */
    public function getNotVotedAmount(): int
    {
        return (int) $this->getAttribute(static::ATTRIBUTE_NOT_VOTED_AMOUNT);
    }

    /**
     * @return int
     */
    public function getMissedAmount(): int
    {
        return (int) $this->getAttribute(static::ATTRIBUTE_MISSED_AMOUNT);
    }

    /**
     * @return int
     */
    public function getDecision(): int
    {
        return new Decision($this->getAttribute(static::ATTRIBUTE_DECISION));
    }

    /**
     * @return bool
     */
    public function isApprovedDecision(): bool
    {
        // TODO: Implement isApprovedDecision() method.
    }

    /**
     * @return CouncilInterface
     */
    public function getCouncil(): CouncilInterface
    {
        return $this->getRelation(static::RELATION_COUNCIL);
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->getRelation(static::RELATION_SESSION);
    }

    /**
     * @return ConvocationInterface
     */
    public function getConvocation(): ConvocationInterface
    {
        return $this->getRelation(static::RELATION_CONVOCATION);
    }

    /**
     * @return VoteTypeInterface
     */
    public function getType(): VoteTypeInterface
    {
        return $this->getRelation(static::RELATION_TYPE);
    }

    /**
     * @return VoterInterface[]
     */
    public function getVoters()
    {
        return $this->getRelation(static::RELATION_VOTERS);
    }

    /**
     * @return VoteBlankInterface[]
     */
    public function getBlanks()
    {
        return $this->getRelation(static::RELATION_BLANKS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function council()
    {
        return $this->belongsTo(Council::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function convocation()
    {
        return $this->belongsTo(Convocation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(VoteType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function voters()
    {
        return $this->hasManyThrough(Voter::class, 'vote_blanks', 'id', 'voter_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blanks()
    {
        return $this->hasMany(VoteBlank::class);
    }
}