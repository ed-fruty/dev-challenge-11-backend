<?php

namespace App\Common\Document\Infrastructure\Eloquent;


use App\Common\Document\Concern\ValueObjects\DocumentId;
use App\Common\Document\Contracts\DocumentFactoryInterface;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentRepositoryInterface;
use App\Common\Specifications\Contracts\SpecificationInterface;
use App\Common\Specifications\Contracts\SpecificationSearchAwareInterface;
use App\Common\Specifications\Traits\SpecificationSearchAware;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class DocumentRepository
 * @package App\Common\Document\Infrastructure\Eloquent
 */
class DocumentRepository implements DocumentRepositoryInterface, SpecificationSearchAwareInterface
{
    use SpecificationSearchAware;

    /**
     * @var Document
     */
    private $model;

    /**
     * DocumentRepository constructor.
     * @param Document $model
     */
    public function __construct(Document $model)
    {
        $this->model = $model;
    }

    /**
     * @param DocumentId $id
     * @return DocumentInterface
     * @throws ModelNotFoundException
     */
    public function findOrFail(DocumentId $id): DocumentInterface
    {
        /** @var DocumentInterface|Document $document */
        $document = $this->model->newQuery()->findOrFail($id->getValue());

        return $document;
    }

    /**
     * @param DocumentInterface $document
     * @return bool
     */
    public function save(DocumentInterface $document): bool
    {
        /** @var Document $document */
        return $document->save();
    }

    /**
     * @return DocumentFactoryInterface
     */
    public function getDocumentFactory(): DocumentFactoryInterface
    {
        return new DocumentFactory;
    }

    /**
     * @param SpecificationInterface $specification
     * @return mixed|Collection|Paginator|DocumentInterface[]
     */
    public function match(SpecificationInterface $specification)
    {
        return $this->specificationSearch->search(
            $this->model->newQuery(),
            $specification
        );
    }
}