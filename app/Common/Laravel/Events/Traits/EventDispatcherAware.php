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
     * @param EventDispatcherAwareInterface $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcherAwareInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}