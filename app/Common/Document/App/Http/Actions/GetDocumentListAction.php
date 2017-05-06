<?php

namespace App\Common\Document\App\Http\Actions;


use App\Common\Document\App\Http\Requests\GetDocumentListRequest;
use App\Common\Document\App\Http\Responders\GetDocumentListResponder;
use App\Common\Document\Concern\Specifications\StatusSpecification;
use App\Common\Document\Concern\Traits\DocumentRepositoryAware;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentRepositoryAwareInterface;
use App\Common\Specifications\Shared\CollectionsSpecification;
use App\Common\Specifications\Shared\PaginatedSpecification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class GetDocumentListAction implements DocumentRepositoryAwareInterface
{
    use DocumentRepositoryAware;

    /**
     * @param GetDocumentListRequest $request
     * @return Collection|Paginator|DocumentInterface[]
     */
    public function __invoke(GetDocumentListRequest $request)
    {
        $specifications = $this->buildSpecifications($request);

        return $this->documentRepository->match($specifications);
    }

    /**
     * @param GetDocumentListRequest $request
     * @return CollectionsSpecification
     */
    protected function buildSpecifications(GetDocumentListRequest $request)
    {
        $collection = new CollectionsSpecification();

        if ($request->hasStatus()) {
            $collection->push(new StatusSpecification($request->getStatus()));
        }

        return $collection;
    }
}