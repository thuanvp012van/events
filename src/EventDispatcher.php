<?php

namespace Penguin\Component\Event;

use Penguin\Component\Container\BoundMethod;

class EventDispatcher implements EventDispatcherInterface
{
    protected array $listeners = [];

    protected array $sorted = [];

    public function __construct(protected ListenerProviderInterface $listenerProvider) {}

    public function dispatch(string|object $event): void
    {
        $listeners = $this->listenerProvider->getListenersForEvent($event);
        foreach ($listeners as $listener) {
            $stopPropagation = BoundMethod::call($listener, [$event]);
            if ($stopPropagation === false) {
                return;
            }
        }
    }
}