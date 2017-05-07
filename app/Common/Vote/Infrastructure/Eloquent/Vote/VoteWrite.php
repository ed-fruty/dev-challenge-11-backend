<?php

namespace App\Common\Vote\Infrastructure\Eloquent\Vote;


use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Vote\Contracts\Classificators\ConvocationInterface;
use App\Common\Vote\Contracts\Classificators\CouncilInterface;
use App\Common\Vote\Contracts\Classificators\SessionInterface;
use App\Common\Vote\Contracts\Classificators\VoteTypeInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\Vote\VoteWriteInterface;
use Carbon\Carbon;

class VoteWrite extends Vote implements VoteWriteInterface
{
    /**
     * @var Vote
     */
    private $vote;

    /**
     * VoteWrite constructor.
     * @param Vote $vote
     * @param array $attributes
     */
    public function __construct(Vote $vote, array $attributes = [])
    {
        parent::__construct($attributes);

        $this->vote = $vote;
    }

    /**
     * @param DocumentInterface $document
     * @return VoteWriteInterface
     */
    public function setDocument(DocumentInterface $document): VoteWriteInterface
    {
        $this->vote->document()->associate($document);;

        return $this;
    }

    /**
     * @param string $topic
     * @return VoteWriteInterface
     */
    public function setTopic(string $topic): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_TOPIC, $topic);

        return $this;
    }

    /**
     * @param int $number
     * @return VoteWriteInterface
     */
    public function setNumber(int $number): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_NUMBER, $number);

        return $this;
    }

    /**
     * @param Carbon $date
     * @return VoteWriteInterface
     */
    public function setDate(Carbon $date): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_DATE, $date->toDateString());

        return $this;
    }

    /**
     * @param int $approvedAmount
     * @return VoteWriteInterface
     */
    public function setApprovedAmount(int $approvedAmount): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_APPROVED_AMOUNT, $approvedAmount);

        return $this;
    }

    /**
     * @param int $declinedAmount
     * @return VoteWriteInterface
     */
    public function setDeclinedAmount(int $declinedAmount): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_DECLINED_AMOUNT, $declinedAmount);

        return $this;
    }

    /**
     * @param int $abstainedAmount
     * @return VoteWriteInterface
     */
    public function setAbstainedAmount(int $abstainedAmount): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_ABSTAINED_AMOUNT, $abstainedAmount);

        return $this;
    }

    /**
     * @param int $notVotedAmount
     * @return VoteWriteInterface
     */
    public function setNotVotedAmount(int $notVotedAmount): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_NOT_VOTED_AMOUNT, $notVotedAmount);

        return $this;
    }

    /**
     * @param int $missedAmount
     * @return VoteWriteInterface
     */
    public function setMissedAmount(int $missedAmount): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_MISSED_AMOUNT, $missedAmount);

        return $this;
    }

    /**
     * @param $decision
     * @return VoteWriteInterface
     */
    public function setDecision($decision): VoteWriteInterface
    {
        $this->vote->setAttribute(static::ATTRIBUTE_DECISION, $decision);

        return $this;
    }

    /**
     * @param CouncilInterface $council
     * @return VoteWriteInterface
     */
    public function setCouncil(CouncilInterface $council): VoteWriteInterface
    {
        $this->vote->council()->associate($council);

        return $this;
    }

    /**
     * @param SessionInterface $session
     * @return VoteWriteInterface
     */
    public function setSession(SessionInterface $session): VoteWriteInterface
    {
        $this->vote->session()->associate($session);

        return $this;
    }

    /**
     * @param ConvocationInterface $convocation
     * @return VoteWriteInterface
     */
    public function setConvocation(ConvocationInterface $convocation): VoteWriteInterface
    {
        $this->vote->convocation()->associate($convocation);

        return $this;
    }

    /**
     * @param VoteTypeInterface $type
     * @return VoteWriteInterface
     */
    public function setType(VoteTypeInterface $type): VoteWriteInterface
    {
        $this->vote->type()->associate($type);

        return $this;
    }

    /**
     * @return VoteInterface
     */
    public function getReadVote(): VoteInterface
    {
        return $this->vote;
    }
}