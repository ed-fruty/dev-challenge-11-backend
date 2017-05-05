<?php

namespace App\Common\Document\Concern\Reader;

use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentParserInterface;
use App\Common\Document\Contracts\DocumentReaderInterface;

class DocumentReader implements DocumentReaderInterface
{
    /**
     * @var DocumentParserInterface[]
     */
    protected $parsers = [];


    /**
     * @param DocumentParserInterface $parser
     */
    public function addParser(DocumentParserInterface $parser)
    {
        $this->parsers[] = $parser;
    }

    /**
     * @param DocumentInterface $document
     * @return DocumentParserInterface
     * @throws \LogicException
     */
    public function getParser(DocumentInterface $document): DocumentParserInterface
    {
        foreach ($this->parsers as $parser) {
            if ($parser->supports($document)) {
                return $parser;
            }
        }

        throw new ParseDocumentException(sprintf(
            'No supported parsers was found for the document %s', $document->getId()->getValue()
        ));
    }
}
