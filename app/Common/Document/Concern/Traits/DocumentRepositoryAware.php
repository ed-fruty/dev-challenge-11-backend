<?php
namespace App\Common\Document\Concern\Traits;

use App\Common\Document\Contracts\DocumentRepositoryInterface;

trait DocumentRepositoryAware
{
    /**
     * @var DocumentRepositoryInterface
     */
    protected $documentRepository;

    /**
     * @param DocumentRepositoryInterface $documentRepository
     */
    public function setDocumentRepository(DocumentRepositoryInterface $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }
}