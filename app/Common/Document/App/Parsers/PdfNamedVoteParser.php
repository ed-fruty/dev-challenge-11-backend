<?php

namespace App\Common\Document\App\Parsers;

use App\Common\Document\Concern\Reader\ParseDocumentException;
use App\Common\Document\Concern\ValueObjects\ParsedVote;
use App\Common\Document\Concern\ValueObjects\ParsedVoteCollection;
use App\Common\Document\Concern\ValueObjects\ParsedVoter;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentParserInterface;
use App\Common\Laravel\Filesystem\Contracts\FileSystemFactoryAwareInterface;
use App\Common\Laravel\Filesystem\Traits\FilesystemFactoryAware;
use Smalot\PdfParser\Parser;

class PdfNamedVoteParser implements DocumentParserInterface, FileSystemFactoryAwareInterface
{
    use FilesystemFactoryAware;

    protected const SUPPORTED_DOCUMENT_EXTENSION = 'pdf';

    protected const REGEX_VOTES_CONTENT = '~$Рада Голос^~';
    protected const REGEX_ITEM_TOPIC = '~~';
    protected const REGEX_ITEM_NUMBER = '~~';
    protected const REGEX_ITEM_DATE = '~~';
    protected const REGEX_ITEM_APPROVED_AMOUNT = '~~';
    const REGEX_ITEM_DECLINED_AMOUNT = '';
    const REGEX_ITEM_ABSTAINED_AMOUNT = '';
    const REGEX_ITEM_NOT_VOTED_AMOUNT = '';
    const REGEX_ITEM_MISSED_AMOUNT = '';
    const REGEX_ITEM_DECISION = '';
    const REGEX_ITEM_COUNCIL = '';
    const REGEX_ITEM_SESSION = '';
    const REGEX_ITEM_CONVOCATION = '';
    const REGEX_ITEM_VOTE_TYPE = '';
    const REGEX_ITEM_VOTERS_WITH_VOTE = '';

    /**
     * @var DocumentInterface
     */
    protected $document;
    /**
     * @var Parser
     */
    private $parser;

    /**
     * PdfNamedVoteParser constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param DocumentInterface $document
     * @return bool
     */
    public function supports(DocumentInterface $document): bool
    {
        return $document->getExtension() === static::SUPPORTED_DOCUMENT_EXTENSION;
    }

    /**
     * @param DocumentInterface $document
     * @return ParsedVoteCollection
     */
    public function parseVotes(DocumentInterface $document): ParsedVoteCollection
    {
        $votes = [];
        $content = $this->filesystemFactory->disk($this->document->getDisk())
            ->get($document->getFullPath());

        $pdf = $this->parser->parseContent($content);

        preg_match_all(static::REGEX_VOTES_CONTENT, $pdf->getText(), $votesContent);

        foreach ((array) $votesContent as $voteItem) {
            $votes[] = (new ParsedVote)
                ->setTopic($this->parseTopic($voteItem))
                ->setNumber($this->parseNumber($voteItem))
                ->setDate($this->parseVoteDate($voteItem))
                ->setApprovedAmount($this->parseApprovedAmount($voteItem))
                ->setDeclinedAmount($this->parseDeclinedAmount($voteItem))
                ->setAbstainedAmount($this->parseAbstainedAmount($voteItem))
                ->setNotVotedAmount($this->parseNotVotedAmount($voteItem))
                ->setMissedAmount($this->parseMissedAmount($voteItem))
                ->setDecision($this->parseDecision($voteItem))
                ->setCouncil($this->parseCouncil($voteItem))
                ->setSession($this->parseSession($voteItem))
                ->setConvocation($this->parseConvocation($voteItem))
                ->setType($this->parseVoteType($voteItem))
                ->setVoters($this->parseVotersWithVote($voteItem))
           ;
        }

        return new ParsedVoteCollection($votes);
    }

    /**
     * @param string $content
     */
    protected function parseTopic(string $content)
    {
        preg_match(static::REGEX_ITEM_TOPIC, $content, $result);

        return $result['topic'] ?? $this->throwParseException('Can\'t parse vote topic');
    }

    /**
     * @param string $content
     */
    protected function parseNumber(string $content)
    {
        preg_match(static::REGEX_ITEM_NUMBER, $content, $result);

        return $result['number'] ?? $this->throwParseException('Can\'t parse vote number');
    }

    /**
     * @param string $content
     */
    protected function parseVoteDate(string $content)
    {
        preg_match(static::REGEX_ITEM_DATE, $content, $result);

        return $result['date'] ?? $this->throwParseException("Can't parse vote date");
    }

    /**
     * @param string $content
     */
    protected function parseApprovedAmount(string $content)
    {
        preg_match(static::REGEX_ITEM_APPROVED_AMOUNT, $content, $result);
        
        return $result['approved'] ?? $this->throwParseException("Can't parse vote approved amount");
    }

    /**
     * @param string $content
     */
    protected function parseDeclinedAmount(string $content)
    {
        preg_match(static::REGEX_ITEM_DECLINED_AMOUNT, $content, $result);

        return $result['declined'] ?? $this->throwParseException("Can't parse vote declined amount");
    }

    /**
     * @param string $content
     */
    protected function parseAbstainedAmount(string $content)
    {
        preg_match(static::REGEX_ITEM_ABSTAINED_AMOUNT, $content, $result);

        return $result['abstained'] ?? $this->throwParseException("Can't parse vote abstained amount");
    }

    /**
     * @param string $content
     */
    protected function parseNotVotedAmount(string $content)
    {
        preg_match(static::REGEX_ITEM_NOT_VOTED_AMOUNT, $content, $result);

        return $result['notVoted'] ?? $this->throwParseException("Can't parse vote not voted amount");
    }

    /**
     * @param string $content
     */
    protected function parseMissedAmount(string $content)
    {
        preg_match(static::REGEX_ITEM_MISSED_AMOUNT, $content, $result);

        return $result['missed'] ?? $this->throwParseException("Can't parse vote missed amount");
    }

    /**
     * @param string $content
     */
    protected function parseDecision(string $content)
    {
        preg_match(static::REGEX_ITEM_DECISION, $content, $result);

        return $result['decision'] ?? $this->throwParseException("Can't parse vote decision");
    }

    /**
     * @param string $content
     */
    protected function parseCouncil(string $content)
    {
        preg_match(static::REGEX_ITEM_COUNCIL, $content, $result);

        return $result['council'] ?? $this->throwParseException("Can't parse vote council");
    }

    /**
     * @param string $content
     */
    protected function parseSession(string $content)
    {
        preg_match(static::REGEX_ITEM_SESSION, $content, $result);

        return $result['session'] ?? $this->throwParseException("Can't parse vote session");
    }

    /**
     * @param string $content
     */
    protected function parseConvocation(string $content)
    {
        preg_match(static::REGEX_ITEM_CONVOCATION, $content, $result);

        return $result['convocation'] ?? $this->throwParseException("Can't parse vote convocation");
    }

    /**
     * @param string $content
     */
    protected function parseVoteType(string $content)
    {
        preg_match(static::REGEX_ITEM_VOTE_TYPE, $content, $result);

        return $result['type'] ?? $this->throwParseException("Can't parse vote type");
    }

    /**
     * @param string $content
     * @return array
     */
    protected function parseVotersWithVote(string $content)
    {
        preg_match_all(static::REGEX_ITEM_VOTERS_WITH_VOTE, $content, $result);

        return array_map(function($item) {
            return new ParsedVoter($item['name'], $item['vote']);
        }, $result);
    }

    /**
     * @param string $message
     * @throws \RuntimeException
     */
    protected function throwParseException(string $message = 'Parse exception')
    {
        throw new ParseDocumentException($message);
    }
}
