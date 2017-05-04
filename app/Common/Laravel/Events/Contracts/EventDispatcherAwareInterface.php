<?php
namespace App\Common\Laravel\Events\Contracts;

use Illuminate\Contracts\Events\Dispatcher;

interface EventDispatcherAwareInterface
{
    /**
     * @param Dispatcher $eventDispatcher
     */
    public function setEventDispatcher(Dispatcher $eventDispatcher);
}