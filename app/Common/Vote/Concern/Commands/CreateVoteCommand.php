<?php

namespace App\Common\Vote\Concern\Commands;

use App\Common\Document\Concern\ValueObjects\ParsedVote;
use App\Common\Document\Contracts\DocumentInterface;

class CreateVoteCommand
{
    /**
     * @var ParsedVote
     */
    private $parsedVote;

    /**
     * @var DocumentInterface
     */
    private $document;

    /**
     * CreateVoteCommand constructor.
     * @param ParsedVote $parsedVote
     * @param DocumentInterface $document
     */
    public function __construct(ParsedVote $parsedVote, DocumentInterface $document)
    {
        $this->parsedVote = $parsedVote;
        $this->document = $document;
    }

    /**
     * @return ParsedVote
     */
    public function getParsedVote(): ParsedVote
    {
        return $this->parsedVote;
    }

    /**
     * @return DocumentInterface
     */
    public function getDocument(): DocumentInterface
    {
        return $this->document;
    }
}
