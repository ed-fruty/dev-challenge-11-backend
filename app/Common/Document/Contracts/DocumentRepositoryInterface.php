<?php
namespace App\Common\Document\Contracts;

use App\Common\Document\Concern\ValueObjects\DocumentId;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface DocumentRepositoryInterface
{

    /**
     * @param DocumentId $id
     * @return DocumentInterface
     * @throws ModelNotFoundException
     */
    public function findOrFail(DocumentId $id) : DocumentInterface;

    /**
     * @param DocumentInterface $document
     * @return bool
     */
    public function save(DocumentInterface $document) : bool;

    /**
     * @param DocumentId $id
     * @return bool
     */
    public function remove(DocumentId $id) : bool;

    /**
     * @return DocumentFactoryInterface
     */
    public function getDocumentFactory() : DocumentFactoryInterface;
}