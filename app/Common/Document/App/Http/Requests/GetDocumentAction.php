<?php

namespace App\Common\Document\App\Http\Requests;


use App\Common\Document\Concern\Traits\DocumentRepositoryAware;
use App\Common\Document\Concern\ValueObjects\DocumentId;
use App\Common\Document\Contracts\DocumentRepositoryAwareInterface;

class GetDocumentAction implements DocumentRepositoryAwareInterface
{
    use DocumentRepositoryAware;

    /**
     * @param $id
     * @return \App\Common\Document\Contracts\DocumentInterface
     */
    public function __invoke($id)
    {
        return $this->documentRepository->findOrFail(new DocumentId($id));
    }
}