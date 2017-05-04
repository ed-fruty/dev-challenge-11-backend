<?php
namespace App\Common\Document\App\Listeners;

use App\Common\Document\Concern\Events\DocumentWasCreatedEvent;
use App\Common\Laravel\CommandBus\Contracts\CommandBusAwareInterface;
use App\Common\Laravel\CommandBus\Traits\CommandBusAware;

class HandleCreatedDocumentListener implements CommandBusAwareInterface
{
    use CommandBusAware;

    /**
     * @param DocumentWasCreatedEvent $event
     */
    public function handle(DocumentWasCreatedEvent $event)
    {
        $command = new HandleDocumentCommand($event->getDocument()->getId());

        $this->commandBus->dispatch($command);
    }
}