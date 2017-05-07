<?php

namespace App\Common\Vote\Concern\Handlers;


use App\Common\Laravel\Events\Contracts\EventDispatcherAwareInterface;
use App\Common\Laravel\Events\Traits\EventDispatcherAware;
use App\Common\Vote\Concern\Commands\CreateVoteBlankCommand;
use App\Common\Vote\Concern\Events\VoteBlankWasCreatedEvent;
use App\Common\Vote\Concern\Traits\ClassificatorRepositoriesAware;
use App\Common\Vote\Concern\Traits\VoteBlankRepositoryAware;
use App\Common\Vote\Concern\Traits\VoteRepositoryAware;
use App\Common\Vote\Contracts\Classificators\ClassificatorRepositoriesAwareInterface;
use App\Common\Vote\Contracts\Vote\VoteRepositoryAwareInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankInterface;
use App\Common\Vote\Contracts\VoteBlank\VoteBlankRepositoryAwareInterface;

class CreateVoteBlankHandler implements EventDispatcherAwareInterface, VoteRepositoryAwareInterface,
    VoteBlankRepositoryAwareInterface, ClassificatorRepositoriesAwareInterface
{
    use EventDispatcherAware, VoteBlankRepositoryAware, ClassificatorRepositoriesAware, VoteRepositoryAware;

    /**
     * @param CreateVoteBlankCommand $command
     * @return VoteBlankInterface
     */
    public function handle(CreateVoteBlankCommand $command): VoteBlankInterface
    {
        $blank = $this->createBlankInstance($command);

        $this->voteBlankRepository->save($blank);

        $this->eventDispatcher->dispatch(new VoteBlankWasCreatedEvent($blank));

        return $blank;
    }

    /**
     * @param CreateVoteBlankCommand $command
     * @return VoteBlankInterface
     */
    protected function createBlankInstance(CreateVoteBlankCommand $command): VoteBlankInterface
    {
        $vote = $this->voteRepository->findOrFail($command->getVoteId());
        $voter = $this->voterRepository->findOrFail($command->getVoterId());

        $writeBlank = $this->voteBlankRepository->getVoteBlankFactory()->createWriteVoteBlank();

        $writeBlank->setVote($vote)
            ->setVoter($voter)
            ->setVoice($command->getVoice());


        return $writeBlank->getReadVoteBlank();
    }
}