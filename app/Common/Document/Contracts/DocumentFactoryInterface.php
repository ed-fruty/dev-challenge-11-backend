<?php
namespace App\Common\Document\Contracts;

interface DocumentFactoryInterface
{
    /**
     * @return DocumentInterface
     */
    public function createReadDocument() : DocumentInterface;

    /**
     * @param DocumentInterface $document
     * @return DocumentWriteInterface
     */
    public function createWriteDocument(DocumentInterface $document = null) : DocumentWriteInterface;
}