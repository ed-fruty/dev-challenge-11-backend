<?php

namespace App\Common\Vote\Contracts\Vote;

use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Vote\Concern\ValueObjects\Decision;
use App\Common\Vote\Concern\ValueObjects\VoteId;
use App\Common\Vote\Contracts\Classificators\ConvocationInterface;
use App\Common\Vote\Contracts\Classificators\CouncilInterface;
use App\Common\Vote\Contracts\Classificators\SessionInterface;
use App\Common\Vote\Contracts\Classificators\VoterInterface;
use App\Common\Vote\Contracts\Classificators\VoteTypeInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use Carbon\Carbon;

interface VoteInterface
{
    /**
     * @return VoteId
     */
    public function getId() : VoteId;

    /**
     * @return string
     */
    public function getTopic() : string;

    /**
     * @return int
     */
    public function getNumber() : int;

    /**
     * @return Carbon
     */
    public function getDate() : Carbon;

    /**
     * @return int
     */
    public function getApprovedAmount() : int;

    /**
     * @return int
     */
    public function getDeclinedAmount() : int;

    /**
     * @return int
     */
    public function getAbstainedAmount() : int;

    /**
     * @return int
     */
    public function getNotVotedAmount() : int;

    /**
     * @return int
     */
    public function getMissedAmount() : int;

    /**
     * @return Decision
     */
    public function getDecision() : Decision;

    /**
     * @return CouncilInterface
     */
    public function getCouncil() : CouncilInterface;

    /**
     * @return SessionInterface
     */
    public function getSession() : SessionInterface;

    /**
     * @return ConvocationInterface
     */
    public function getConvocation() : ConvocationInterface;

    /**
     * @return VoteTypeInterface
     */
    public function getType() : VoteTypeInterface;

    /**
     * @return VoterInterface[]
     */
    public function getVoters();

    /**
     * @return VoteBlankInterface[]
     */
    public function getBlanks();

    /**
     * @return DocumentInterface
     */
    public function getDocument(): DocumentInterface;
}
