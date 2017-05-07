<?php
/**
 * Created by PhpStorm.
 * User: fruty
 * Date: 06.05.17
 * Time: 11:21
 */

namespace App\Common\Vote\Concern\Commands;


use App\Common\Vote\Concern\ValueObjects\ClassificatorId;
use App\Common\Vote\Concern\ValueObjects\Voice;
use App\Common\Vote\Concern\ValueObjects\VoteId;

class CreateVoteBlankCommand
{
    /**
     * @var VoteId
     */
    private $voteId;
    /**
     * @var ClassificatorId
     */
    private $voterId;
    /**
     * @var int
     */
    private $voice;

    /**
     * CreateVoteBlankCommand constructor.
     * @param VoteId $voteId
     * @param ClassificatorId $voterId
     * @param Voice $voice
     */
    public function __construct(VoteId $voteId, ClassificatorId $voterId, Voice $voice)
    {
        $this->voteId = $voteId;
        $this->voterId = $voterId;
        $this->voice = $voice;
    }

    /**
     * @return VoteId
     */
    public function getVoteId(): VoteId
    {
        return $this->voteId;
    }

    /**
     * @return ClassificatorId
     */
    public function getVoterId(): ClassificatorId
    {
        return $this->voterId;
    }

    /**
     * @return Voice
     */
    public function getVoice(): Voice
    {
        return $this->voice;
    }
}