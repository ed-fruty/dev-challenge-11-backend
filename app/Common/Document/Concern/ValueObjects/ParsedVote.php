<?php

namespace App\Common\Document\Concern\ValueObjects;

use Carbon\Carbon;

class ParsedVote
{
    /**
     * @var string
     */
    protected $topic;

    /**
     * @var string|null
     */
    protected $number;

    /**
     * @var Carbon
     */
    protected $date;

    /**
     * @var int
     */
    protected $approvedAmount;

    /**
     * @var int
     */
    protected $declinedAmount;

    /**
     * @var int
     */
    protected $abstainedAmount;

    /**
     * @var int
     */
    protected $notVotedAmount;

    /**
     * @var int
     */
    protected $missedAmount;

    /**
     * @var int
     */
    protected $decision;

    /**
     * @var string
     */
    protected $council;

    /**
     * @var string
     */
    protected $session;

    /**
     * @var string
     */
    protected $convocation;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var ParsedVoter[]
     */
    protected $voters;

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->topic;
    }

    /**
     * @param string $topic
	 * @return $this
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;
		return $this;
    }

    /**
     * @return null|string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param null|string $number
	 * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
		return $this;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon $date
	 * @return $this
	 * @return $this
     */
    public function setDate(Carbon $date)
    {
        $this->date = $date;
		return $this;
    }

    /**
     * @return int
     */
    public function getApprovedAmount(): int
    {
        return $this->approvedAmount;
    }

    /**
     * @param int $approvedAmount
	 * @return $this
     */
    public function setApprovedAmount(int $approvedAmount)
    {
        $this->approvedAmount = $approvedAmount;
		return $this;
    }

    /**
     * @return int
     */
    public function getDeclinedAmount(): int
    {
        return $this->declinedAmount;
    }

    /**
     * @param int $declinedAmount
	 * @return $this
     */
    public function setDeclinedAmount(int $declinedAmount)
    {
        $this->declinedAmount = $declinedAmount;
		return $this;
    }

    /**
     * @return int
     */
    public function getAbstainedAmount(): int
    {
        return $this->abstainedAmount;
    }

    /**
     * @param int $abstainedAmount
	 * @return $this
     */
    public function setAbstainedAmount(int $abstainedAmount)
    {
        $this->abstainedAmount = $abstainedAmount;
		return $this;
    }

    /**
     * @return int
     */
    public function getNotVotedAmount(): int
    {
        return $this->notVotedAmount;
    }

    /**
     * @param int $notVotedAmount
	 * @return $this
     */
    public function setNotVotedAmount(int $notVotedAmount)
    {
        $this->notVotedAmount = $notVotedAmount;
		return $this;
    }

    /**
     * @return int
     */
    public function getMissedAmount(): int
    {
        return $this->missedAmount;
    }

    /**
     * @param int $missedAmount
	 * @return $this
     */
    public function setMissedAmount(int $missedAmount)
    {
        $this->missedAmount = $missedAmount;
		return $this;
    }

    /**
     * @return int
     */
    public function getDecision(): int
    {
        return $this->decision;
    }

    /**
     * @param int $decision
	 * @return $this
     */
    public function setDecision(int $decision)
    {
        $this->decision = $decision;
		return $this;
    }

    /**
     * @return string
     */
    public function getCouncil(): string
    {
        return $this->council;
    }

    /**
     * @param string $council
	 * @return $this
     */
    public function setCouncil(string $council)
    {
        $this->council = $council;
		return $this;
    }

    /**
     * @return string
     */
    public function getSession(): string
    {
        return $this->session;
    }

    /**
     * @param string $session
	 * @return $this
     */
    public function setSession(string $session)
    {
        $this->session = $session;
		return $this;
    }

    /**
     * @return string
     */
    public function getConvocation(): string
    {
        return $this->convocation;
    }

    /**
     * @param string $convocation
	 * @return $this
     */
    public function setConvocation(string $convocation)
    {
        $this->convocation = $convocation;
		return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
	 * @return $this
     */
    public function setType(int $type)
    {
        $this->type = $type;
		return $this;
    }

    /**
     * @return ParsedVoter[]
     */
    public function getVoters(): array
    {
        return $this->voters;
    }

    /**
     * @param ParsedVoter[] $voters
	 * @return $this
     */
    public function setVoters(array $voters)
    {
        $this->voters = $voters;
		return $this;
    }
}
