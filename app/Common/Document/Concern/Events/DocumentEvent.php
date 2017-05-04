<?php
namespace App\Common\Document\Concern\Events;

use App\Common\Document\Contracts\DocumentInterface;

abstract class DocumentEvent
{
    public const DOCUMENT_WAS_CREATED_EVENT = DocumentWasCreatedEvent::class;


    /**
     * @var DocumentInterface
     */
    private $document;

    /**
     * DocumentEvent constructor.
     * @param DocumentInterface $document
     */
    public function __construct(DocumentInterface $document)
    {
        $this->document = $document;
    }

    /**
     * @return DocumentInterface
     */
    public function getDocument(): DocumentInterface
    {
        return $this->document;
    }
}