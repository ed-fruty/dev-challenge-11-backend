<?php
namespace App\Common\Document\Concern\Commands;

use App\Common\Document\Concern\ValueObjects\DocumentId;

class MarkDocumentAsProcessCommand
{
    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * MarkDocumentAsProcessCommand constructor.
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