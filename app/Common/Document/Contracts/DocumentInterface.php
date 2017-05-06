<?php
namespace App\Common\Document\Contracts;

use App\Common\Document\Concern\ValueObjects\DocumentId;
use App\Common\Vote\Contracts\Vote\VoteInterface;
use Illuminate\Database\Eloquent\Collection;

interface DocumentInterface
{
    public const STATUS_UNPROCESSED = 0;
    public const STATUS_PROCESSED = 1;

    /**
     * @return DocumentId
     */
    public function getId() : DocumentId;

    /**
     * @return string
     */
    public function getExtension() : string;

    /**
     * @return string
     */
    public function getFilename() : string;

    /**
     * @return string
     */
    public function getPath() : string;

    /**
     * @return string
     */
    public function getFullPath() : string;

    /**
     * @return string
     */
    public function getDisk() : string;

    /**
     * @return int
     */
    public function getStatus() : int;

    /**
     * @return bool
     */
    public function isProcessed() : bool;

    /**
     * @return VoteInterface[]|Collection
     */
    public function getVotes();
}