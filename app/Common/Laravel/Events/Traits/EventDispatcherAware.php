<?php
namespace App\Common\Laravel\Events\Traits;

use App\Common\Laravel\Events\Contracts\EventDispatcherAwareInterface;
use Illuminate\Contracts\Events\Dispatcher;

trait EventDispatcherAware
{
    /**
     * @var Dispatcher
     */
    protected $eventDispatcher;

    /**
     * @param Dispatcher $eventDispatcher
     */
    public function setEventDispatcher(Dispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}