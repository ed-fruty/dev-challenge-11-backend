<?php
namespace App\Common\Vote\Contracts\Classificators;

use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;

interface VoterInterface extends ClassificatorInterface
{
    /**
     * @return VoteBlankInterface[]
     */
    public function getBlanks();

    /**
     * @return VoteInterface[]
     */
    public function getVotes();
}