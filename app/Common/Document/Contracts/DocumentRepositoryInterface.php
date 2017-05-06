<?php
namespace App\Common\Document\Contracts;

use App\Common\Document\Concern\ValueObjects\DocumentId;
use App\Common\Specifications\Contracts\SpecificationInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
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
     * @return DocumentFactoryInterface
     */
    public function getDocumentFactory() : DocumentFactoryInterface;

    /**
     * @param SpecificationInterface $specification
     * @return mixed|Collection|Paginator|DocumentInterface[]
     */
    public function match(SpecificationInterface $specification);
}