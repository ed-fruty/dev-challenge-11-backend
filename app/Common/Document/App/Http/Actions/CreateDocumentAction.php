<?php
namespace App\Common\Document\App\Http\Actions;

use App\Common\Document\App\Http\Requests\CreateDocumentRequest;
use App\Common\Document\Concern\Commands\CreateDocumentCommand;
use App\Common\Laravel\CommandBus\Contracts\CommandBusAwareInterface;
use App\Common\Laravel\CommandBus\Traits\CommandBusAware;

class CreateDocumentAction implements CommandBusAwareInterface
{
    use CommandBusAware;

    /**
     * @param CreateDocumentRequest $request
     * @return mixed
     */
    public function __invoke(CreateDocumentRequest $request)
    {
        $command = new CreateDocumentCommand($request->file('document'));

        return $this->commandBus->dispatchNow($command);
    }
}