<?php

namespace App\Common\Document\Infrastructure\Eloquent;


use App\Common\Document\Concern\ValueObjects\DocumentId;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Document extends Model implements DocumentInterface
{
    protected const ATTRIBUTE_FILENAME = 'filename';
    protected const ATTRIBUTE_PATH = 'path';
    protected const ATTRIBUTE_DISK = 'disk';
    protected const ATTRIBUTE_STATUS = 'status';

    protected const RELATION_VOTES = 'votes';

    /**
     * @var string
     */
    protected $table = 'documents';

    /**
     * @return DocumentId
     */
    public function getId(): DocumentId
    {
        return new DocumentId($this->getKey());
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return pathinfo($this->getFilename(), PATHINFO_EXTENSION);
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->getAttribute(static::ATTRIBUTE_FILENAME);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->getAttribute(static::ATTRIBUTE_PATH);
    }

    /**
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->getPath() . '/' . $this->getFilename();
    }

    /**
     * @return string
     */
    public function getDisk(): string
    {
        return $this->getAttribute(static::ATTRIBUTE_DISK);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return (int) $this->getAttribute(static::ATTRIBUTE_STATUS);
    }

    /**
     * @return bool
     */
    public function isProcessed(): bool
    {
        return $this->getStatus() === static::STATUS_PROCESSED;
    }

    /**
     * @return VoteInterface[]|Collection
     */
    public function getVotes()
    {
        return $this->getRelation(static::RELATION_VOTES);
    }

    /**
     * Votes relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}