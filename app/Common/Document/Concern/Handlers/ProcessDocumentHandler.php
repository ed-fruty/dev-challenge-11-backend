<?php

namespace App\Common\Document\Concern\Handlers;

use App\Common\Document\Concern\Commands\MarkDocumentAsProcessedCommand;
use App\Common\Document\Concern\Commands\ProcessDocumentCommand;
use App\Common\Document\Concern\Traits\DocumentRepositoryAware;
use App\Common\Document\Concern\ValueObjects\ParsedVote;
use App\Common\Document\Concern\ValueObjects\ParsedVoter;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentReaderInterface;
use App\Common\Document\Contracts\DocumentRepositoryAwareInterface;
use App\Common\Laravel\CommandBus\Contracts\CommandBusAwareInterface;
use App\Common\Laravel\CommandBus\Traits\CommandBusAware;
use App\Common\Vote\Concern\Commands\CreateVoteBlankCommand;
use App\Common\Vote\Concern\Commands\CreateVoteCommand;
use App\Common\Vote\Concern\Traits\ClassificatorRepositoriesAware;
use App\Common\Vote\Contracts\Classificators\ClassificatorRepositoriesAwareInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;

/**
 * Class ProcessDocumentHandler
 * @package App\Common\Document\Concern\Handlers
 */
class ProcessDocumentHandler implements
    DocumentRepositoryAwareInterface, ClassificatorRepositoriesAwareInterface, CommandBusAwareInterface
{
    use DocumentRepositoryAware, ClassificatorRepositoriesAware, CommandBusAware;

    /**
     * @var DocumentReaderInterface
     */
    private $documentReader;

    /**
     * ProcessDocumentHandler constructor.
     * @param DocumentReaderInterface $documentReader
     */
    public function __construct(DocumentReaderInterface $documentReader)
    {
        $this->documentReader = $documentReader;
    }

    /**
     * @param ProcessDocumentCommand $command
     */
    public function handle(ProcessDocumentCommand $command)
    {
        $document = $this->documentRepository->findOrFail($command->getDocumentId());

        $parser = $this->documentReader->getParser($document);

        foreach ($parser->parseVotes($document)->all() as $parsedVote) {

            $entityVote = $this->createVote($parsedVote, $document);
            $this->writeVoteBlanks($entityVote, $parsedVote->getVoters());
        }

        $this->markDocumentAsProcessed($document);
    }

    /**
     * @param ParsedVote $parsedVote
     * @param DocumentInterface $document
     * @return VoteInterface
     */
    protected function createVote(ParsedVote $parsedVote, DocumentInterface $document): VoteInterface
    {
        $command = new CreateVoteCommand($parsedVote, $document);

        return $this->commandBus->dispatchNow($command);
    }

    /**
     * @param VoteInterface $vote
     * @param array $voters
     */
    protected function writeVoteBlanks(VoteInterface $vote, array $voters)
    {
        /** @var ParsedVoter $voter */
        foreach ($voters as $voter) {
            $voterEntity = $this->voterRepository->findByNameOrCreate($voter->getName());

            $command = new CreateVoteBlankCommand($vote->getId(), $voterEntity->getId(), $voter->getVote());
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
