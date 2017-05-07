<?php

namespace App\Common\Document\Infrastructure\Eloquent;


use App\Common\Document\Concern\ValueObjects\Status;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentWriteInterface;

class DocumentWrite extends Document implements DocumentWriteInterface
{
    /**
     * @var Document
     */
    private $document;

    /**
     * DocumentWrite constructor.
     * @param Document $document
     * @param array $attributes
     */
    public function __construct(Document $document, array $attributes = [])
    {
        parent::__construct($attributes);

        $this->document = $document;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename)
    {
        $this->document->setAttribute(static::ATTRIBUTE_FILENAME, $filename);
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->document->setAttribute(static::ATTRIBUTE_PATH, $path);
    }

    /**
     * @param string $disk
     */
    public function setDisk(string $disk)
    {
        $this->document->setAttribute(static::ATTRIBUTE_DISK, $disk);
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status)
    {
        $this->document->setAttribute(static::ATTRIBUTE_STATUS, $status->getValue());
    }

    /**
     * @return DocumentInterface
     */
    public function getReadDocument(): DocumentInterface
    {
        return $this->document;
    }
}