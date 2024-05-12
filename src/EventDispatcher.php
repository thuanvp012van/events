<?php

namespace Penguin\Component\Event;

use Penguin\Component\Container\BoundMethod;

class EventDispatcher implements EventDispatcherInterface
{
    protected array $listeners = [];

    protected array $sorted = [];

    public function __construct(protected ListenerProviderInterface $listenerProvider) {}

    public function dispatch(string|object $event, array $payload = []): void
    {
        $listeners = $this->listenerProvider->getListenersForEvent($event);
        if (is_object($event)) {
            array_unshift($payload, $event);
        }
        foreach ($listeners as $listener) {
            $stopPropagation = BoundMethod::call($listener, $payload);
            if ($stopPropagation === false) {
                return;
            }
        }
    }
}