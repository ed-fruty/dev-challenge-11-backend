<?php

namespace App\Common\Document\Infrastructure\Eloquent;


use App\Common\Document\Contracts\DocumentFactoryInterface;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentWriteInterface;

class DocumentFactory implements DocumentFactoryInterface
{

    /**
     * @return DocumentInterface
     */
    public function createReadDocument(): DocumentInterface
    {
        return new Document;
    }

    /**
     * @param DocumentInterface $document
     * @return DocumentWriteInterface
     */
    public function createWriteDocument(DocumentInterface $document = null): DocumentWriteInterface
    {
        /** @var Document $document */
        $document = $document ?: $this->createReadDocument();

        return new DocumentWrite($document);
    }
}