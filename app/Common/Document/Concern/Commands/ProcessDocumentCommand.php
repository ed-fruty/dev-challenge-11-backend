<?php
namespace App\Common\Document\Concern\Commands;

use App\Common\Document\Concern\ValueObjects\DocumentId;

final class ProcessDocumentCommand
{
    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * HandleDocumentCommand constructor.
     * @param DocumentId $documentId
     */
    public function __construct(DocumentId $documentId)
    {
        $this->documentId = $documentId;
    }

    /**
     * @return DocumentId
     */
    public function getDocumentId(): DocumentId
    {
        return $this->documentId;
    }
}