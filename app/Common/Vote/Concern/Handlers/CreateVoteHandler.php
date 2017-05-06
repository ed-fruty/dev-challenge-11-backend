<?php

namespace App\Common\Vote\Concern\Handlers;

use App\Common\Laravel\Events\Contracts\EventDispatcherAwareInterface;
use App\Common\Laravel\Events\Traits\EventDispatcherAware;
use App\Common\Vote\Concern\Commands\CreateVoteCommand;
use App\Common\Vote\Concern\Events\VoteWasCreatedEvent;
use App\Common\Vote\Concern\Traits\ClassificatorRepositoriesAware;
use App\Common\Vote\Concern\Traits\VoteRepositoryAware;
use App\Common\Vote\Contracts\Classificators\ClassificatorRepositoriesAwareInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use App\Common\Vote\Contracts\Vote\VoteRepositoryAwareInterface;

class CreateVoteHandler implements VoteRepositoryAwareInterface, EventDispatcherAwareInterface,
    ClassificatorRepositoriesAwareInterface
{
    use VoteRepositoryAware, EventDispatcherAware, ClassificatorRepositoriesAware;

    /**
     * @param CreateVoteCommand $command
     * @return VoteInterface
     */
    public function handle(CreateVoteCommand $command)
    {
        $vote = $this->createVoteInstance($command);

        $this->voteRepository->save($vote);

        $this->eventDispatcher->dispatch(new VoteWasCreatedEvent($vote));

        return $vote;
    }

    /**
     * @param CreateVoteCommand $command
     * @return VoteInterface
     */
    protected function createVoteInstance(CreateVoteCommand $command): VoteInterface
    {
        $council = $this->councilRepository->findByNameOrCreate($command->getParsedVote()->getCouncil());
        $session = $this->sessionRepository->findByNameOrCreate($command->getParsedVote()->getSession());
        $convocation = $this->convocationRepository->findByNameOrCreate($command->getParsedVote()->getConvocation());
        $voteType = $this->voteTypeRepository->findByNameOrCreate($command->getParsedVote()->getType());

        $writeVote = $this->voteRepository->getVoteFactory()->createWriteVote();
        $writeVote
            ->setTopic($command->getParsedVote()->getTopic())
            ->setNumber($command->getParsedVote()->getNumber())
            ->setDocument($command->getDocument())
            ->setDate($command->getParsedVote()->getDate())
            ->setApprovedAmount($command->getParsedVote()->getApprovedAmount())
            ->setDeclinedAmount($command->getParsedVote()->getDeclinedAmount())
            ->setAbstainedAmount($command->getParsedVote()->getAbstainedAmount())
            ->setNotVotedAmount($command->getParsedVote()->getNotVotedAmount())
            ->setMissedAmount($command->getParsedVote()->getMissedAmount())
            ->setDecision($command->getParsedVote()->getDecision())
            ->setCouncil($council)
            ->setSession($session)
            ->setConvocation($convocation)
            ->setType($voteType);

        return $writeVote->getReadVote();
    }
}
