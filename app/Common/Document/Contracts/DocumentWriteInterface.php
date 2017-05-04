<?php
namespace App\Common\Document\Contracts;

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
     * @param int $status
     */
    public function setStatus(int $status);

    /**
     * @return DocumentInterface
     */
    public function getReadDocument() : DocumentInterface;
}