<?php
namespace App\Common\Document\Contracts;

use App\Common\Document\Concern\ValueObjects\Status;

interface DocumentWriteInterface
{
    /**
     * @param string $filename
     */
    public function setFilename(string $filename);

    /**
     * @param string $path
     */
    public function setPath(string $path);

    /**
     * @param string $disk
     */
    public function setDisk(string $disk);

    /**
     * @param Status $status
     */
    public function setStatus(Status $status);

    /**
     * @return DocumentInterface
     */
    public function getReadDocument() : DocumentInterface;
}