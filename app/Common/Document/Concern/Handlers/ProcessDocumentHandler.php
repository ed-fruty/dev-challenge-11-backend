<?php
namespace App\Common\Document\Concern\Handlers;

use App\Common\Document\Concern\Commands\ProcessDocumentCommand;
use App\Common\Document\Concern\Traits\DocumentRepositoryAware;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentRepositoryAwareInterface;
use App\Common\Vote\Concern\Traits\ClassificatorRepositoriesAware;
use App\Common\Vote\Contracts\Classificators\ClassificatorRepositoriesAwareInterface;

class ProcessDocumentHandler implements DocumentRepositoryAwareInterface, ClassificatorRepositoriesAwareInterface
{
    use DocumentRepositoryAware, ClassificatorRepositoriesAware;

    /**
     * @param ProcessDocumentCommand $command
     */
    public function handle(ProcessDocumentCommand $command)
    {
        $document = $this->documentRepository->findOrFail($command->getDocumentId());

        $parser = $this->documentReader->getParser($document);

        $vote = $this->createVote($parser);
        $this->writeVoteResults($vote, $parser->getVoters());
        $this->markDocumentAsProcessed($document);

    }

    /**
     * @param $parser
     * @return mixed
     */
    protected function createVote($parser)
    {
        $council = $this->councilRepository->findByNameOrCreate($parser->getCouncil());
        $session = $this->sessionRepository->findByNameOrCreate($parser->getSession());
        $convocation = $this->convocationRepository->findByNameOrCreate($parser->getConvocation());
        $voteType = $this->voteTypeRepository->findByNameOrCreate($parser->getVoteType());

        $writeVote = $this->voteRepository->getVoteFactory()->createWriteVote();
        $writeVote
            ->setTopic($parser->getTopic())
            ->setNumber($parser->getNumber())
            ->setDocument($parser->getDocument())
            ->setVoteDate($parser->getVoteDate())
            ->setApprovedAmount($parser->getApprovedAmount())
            ->setDeclinedAmount($parser->getDeclinedAmount())
            ->setAbstainedAmount($parser->getAbstainedAmount())
            ->setNotVotedAmount($parser->getNotVotedAmount())
            ->setMissedAmount($parser->getMissedAmount())
            ->setDecision($parser->getDecision())
            ->setCouncil($council)
            ->setSession($session)
            ->setConvocation($convocation)
            ->setVoteType($voteType);

        return $writeVote->getReadVote();
    }

    /**
     * @param VoteInterface $vote
     * @param array $voters
     */
    protected function writeVoteResults(VoteInterface $vote, array $voters)
    {
        /** @var ParsedVoter $voter */
        foreach ($voters as $voter) {
            $voterEntity = $this->voterRepository->findByNameOrCreate($voter->getName());

            $command = new CreateVoteBlankCommand($vote->getId(), $voterEntity->getId(), $voter->getDecision());
            $this->commandBus->dispatch($command);
        };
    }

    /**
     * @param DocumentInterface $document
     */
    protected function markDocumentAsProcessed(DocumentInterface $document)
    {
        $command = new MarkDocumentAsProcessedCommand($document->getId());

        $this->commandBus->dispatch($command);
    }
}
