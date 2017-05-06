<?php

namespace App\Common\Document\App\Http\Actions;


use App\Common\Document\App\Http\Requests\GetDocumentListRequest;
use App\Common\Document\Concern\Traits\DocumentRepositoryAware;
use App\Common\Document\Contracts\DocumentRepositoryAwareInterface;

class GetDocumentListAction implements DocumentRepositoryAwareInterface
{
    use DocumentRepositoryAware;

    /**
     * @param GetDocumentListRequest $request
     * @param GetDocumentListResponder $responder
     */
    public function __invoke(GetDocumentListRequest $request, GetDocumentListResponder $responder)
    {
        $specifications = $this->buildSpecifications($request);

        $documents = $this->documentRepository->match();
    }

    /**
     * @param GetDocumentListRequest $request
     * @return SpecificationCollection
     */
    protected function buildSpecifications(GetDocumentListRequest $request)
    {
        $collection = new SpecificationCollection();
        $collection->push(new PaginedSpecification());

        if ($request->hasStatus()) {
            $collection->push(new StatusSpecification($request->getStatus()));
        }

        return $collection;
    }
}