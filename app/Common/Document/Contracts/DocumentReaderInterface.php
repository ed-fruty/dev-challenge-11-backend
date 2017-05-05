<?php

namespace App\Common\Document\Contracts;

interface DocumentReaderInterface
{
    /**
     * @param DocumentParserInterface $parser
     */
    public function addParser(DocumentParserInterface $parser);

    /**
     * @param DocumentInterface $document
     * @return DocumentParserInterface
     * @throws \LogicException
     */
    public function getParser(DocumentInterface $document) : DocumentParserInterface;
}
