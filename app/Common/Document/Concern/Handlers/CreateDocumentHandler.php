<?php
namespace App\Common\Document\Concern\Handlers;

use App\Common\Document\Concern\Commands\CreateDocumentCommand;
use App\Common\Document\Concern\Events\DocumentWasCreatedEvent;
use App\Common\Document\Concern\Traits\DocumentRepositoryAware;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentRepositoryAwareInterface;
use App\Common\Document\Contracts\FilenameGeneratorInterface;
use App\Common\Laravel\Events\Contracts\EventDispatcherAwareInterface;
use App\Common\Laravel\Events\Traits\EventDispatcherAware;

class CreateDocumentHandler implements DocumentRepositoryAwareInterface, EventDispatcherAwareInterface
{
    use DocumentRepositoryAware, EventDispatcherAware;

    /**
     * @var FilenameGeneratorInterface
     */
    private $filenameGenerator;

    /**
     * CreateDocumentHandler constructor.
     * @param FilenameGeneratorInterface $filenameGenerator
     */
    public function __construct(FilenameGeneratorInterface $filenameGenerator)
    {
        $this->filenameGenerator = $filenameGenerator;
    }

    /**
     * @param CreateDocumentCommand $command
     * @return DocumentInterface
     */
    public function handle(CreateDocumentCommand $command)
    {
        /*
         * Define vars
         */
        $filename = $this->filenameGenerator->fromUploadedFile($command->getFile());
        $path = storage_path('documents');
        $disk = env('FILESYSTEM_DRIVER');

        /*
         * Store file local or on the cloud
         */
        $command->getFile()->storeAs($path, $filename, compact('disk'));

        /*
         * Create document entity
         */
        $document = $this->createDocumentInstance($filename, $path, $disk);

        $this->documentRepository->save($document);

        /*
         * Notify to all about new document
         */
        $this->eventDispatcher->dispatch(new DocumentWasCreatedEvent($document));

        return $document;
    }

    /**
     * @param string $filename
     * @param string $path
     * @param string $disk
     * @return DocumentInterface
     */
    private function createDocumentInstance(string $filename, string $path, string $disk)
    {
        $writeDocument = $this->documentRepository->getDocumentFactory()->createWriteDocument();
        $writeDocument->setPath($path);
        $writeDocument->setFilename($filename);
        $writeDocument->setDisk($disk);
        $writeDocument->setStatus(DocumentInterface::STATUS_UNPROCESSED);

        return $writeDocument->getReadDocument();
    }
}