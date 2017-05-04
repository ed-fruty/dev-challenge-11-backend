<?php
namespace App\Common\Document\Concern\Handlers;

use App\Common\Document\Concern\Commands\MarkDocumentAsProcessCommand;
use App\Common\Document\Concern\Events\DocumentWasProcessedEvent;
use App\Common\Document\Concern\Traits\DocumentRepositoryAware;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentRepositoryAwareInterface;
use App\Common\Laravel\Events\Contracts\EventDispatcherAwareInterface;
use App\Common\Laravel\Events\Traits\EventDispatcherAware;

class MarkDocumentAsProcessedHandler implements DocumentRepositoryAwareInterface, EventDispatcherAwareInterface
{
    use DocumentRepositoryAware, EventDispatcherAware;

    /**
     * @param MarkDocumentAsProcessCommand $command
     */
    public function handle(MarkDocumentAsProcessCommand $command)
    {
        $document = $this->documentRepository->findOrFail($command->getDocumentId());

        $writeDocument = $this->documentRepository->getDocumentFactory()->createWriteDocument($document);
        $writeDocument->setStatus(DocumentInterface::STATUS_PROCESSED);

        $this->documentRepository->save($writeDocument->getReadDocument());

        $this->eventDispatcher->dispatch(new DocumentWasProcessedEvent($writeDocument->getReadDocument()));
    }
}