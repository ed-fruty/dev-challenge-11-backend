<?php

namespace App\Common\Vote\Contracts\Vote;

use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Vote\Contracts\Classificators\ConvocationInterface;
use App\Common\Vote\Contracts\Classificators\CouncilInterface;
use App\Common\Vote\Contracts\Classificators\SessionInterface;
use App\Common\Vote\Contracts\Classificators\VoteTypeInterface;
use Carbon\Carbon;

interface VoteWriteInterface
{
    /**
     * @param DocumentInterface $document
     * @return VoteWriteInterface
     */
    public function setDocument(DocumentInterface $document): VoteWriteInterface;

    /**
     * @param string $topic
     * @return VoteWriteInterface
     */
    public function setTopic(string $topic): VoteWriteInterface;

    /**
     * @param int $number
     * @return VoteWriteInterface
     */
    public function setNumber(int $number): VoteWriteInterface;

    /**
     * @param Carbon $date
     * @return VoteWriteInterface
     */
    public function setDate(Carbon $date): VoteWriteInterface;

    /**
     * @param int $approvedAmount
     * @return VoteWriteInterface
     */
    public function setApprovedAmount(int $approvedAmount): VoteWriteInterface;

    /**
     * @param int $declinedAmount
     * @return VoteWriteInterface
     */
    public function setDeclinedAmount(int $declinedAmount): VoteWriteInterface;

    /**
     * @param int $abstainedAmount
     * @return VoteWriteInterface
     */
    public function setAbstainedAmount(int $abstainedAmount): VoteWriteInterface;

    /**
     * @param int $notVotedAmount
     * @return VoteWriteInterface
     */
    public function setNotVotedAmount(int $notVotedAmount): VoteWriteInterface;

    /**
     * @param int $missedAmount
     * @return VoteWriteInterface
     */
    public function setMissedAmount(int $missedAmount): VoteWriteInterface;

    /**
     * @param $decision
     * @return VoteWriteInterface
     */
    public function setDecision($decision): VoteWriteInterface;

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

    /**
     * @param ConvocationInterface $convocation
     * @return VoteWriteInterface
     */
    public function setConvocation(ConvocationInterface $convocation): VoteWriteInterface;

    /**
     * @param VoteTypeInterface $type
     * @return VoteWriteInterface
     */
    public function setType(VoteTypeInterface $type): VoteWriteInterface;

    /**
     * @return VoteInterface
     */
    public function getReadVote(): VoteInterface;
}
