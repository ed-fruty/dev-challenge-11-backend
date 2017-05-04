<?php
namespace App\Common\Document\Contracts;

interface DocumentRepositoryAwareInterface 
{
    /**
     * @param DocumentRepositoryInterface $documentRepository
     */
    public function setDocumentRepository(DocumentRepositoryInterface $documentRepository);
}