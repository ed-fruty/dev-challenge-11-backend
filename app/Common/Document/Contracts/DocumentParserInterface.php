<?php

namespace App\Common\Document\Contracts;

use App\Common\Document\Concern\ValueObjects\ParsedVoteCollection;

interface DocumentParserInterface
{
    /**
     * @param DocumentInterface $document
     * @return bool
     */
    public function supports(DocumentInterface $document) : bool;

    /**
     * @param DocumentInterface $document
     * @return ParsedVoteCollection
     */
    public function parseVotes(DocumentInterface $document) : ParsedVoteCollection;
}
