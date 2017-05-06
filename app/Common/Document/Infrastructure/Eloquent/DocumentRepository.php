<?php

namespace App\Common\Document\Infrastructure\Eloquent;


use App\Common\Document\Concern\ValueObjects\DocumentId;
use App\Common\Document\Contracts\DocumentFactoryInterface;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class DocumentRepository
 * @package App\Common\Document\Infrastructure\Eloquent
 */
class DocumentRepository implements DocumentRepositoryInterface
{

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
}