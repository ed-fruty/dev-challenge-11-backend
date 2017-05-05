<?php

namespace App\Common\Vote\Contracts;

use App\Common\Vote\Contracts\Classificators\CouncilInterface;
use App\Common\Vote\Contracts\Classificators\SessionInterface;
use Carbon\Carbon;

interface VoteWriteInterface
{
    /**
     * @param string $topic
     */
    public function setTopic(string $topic);

    /**
     * @param int $number
     * @return mixed
     */
    public function setNumber(int $number);

    /**
     * @param Carbon $date
     * @return mixed
     */
    public function setDate(Carbon $date);

    /**
     * @param int $approvedAmount
     * @return mixed
     */
    public function setApprovedAmount(int $approvedAmount);

    /**
     * @param int $declinedAmount
     * @return mixed
     */
    public function setDeclinedAmount(int $declinedAmount);

    /**
     * @param int $abstainedAmount
     * @return mixed
     */
    public function setAbstainedAmount(int $abstainedAmount);

    /**
     * @param int $notVotedAmount
     * @return mixed
     */
    public function setNotVotedAmount(int $notVotedAmount);

    /**
     * @param int $missedAmount
     * @return mixed
     */
    public function setMissedAmount(int $missedAmount);

    /**
     * @param $decision
     * @return mixed
     */
    public function setDecision($decision);

    /**
     * @param CouncilInterface $council
     * @return VoteWriteInterface
     */
    public function setCouncil(CouncilInterface $council): VoteWriteInterface;

    /**
     * @param SessionInterface $session
     * @return VoteWriteInterface
     */
    public function setSession(SessionInterface $session): VoteWriteInterface;
}
