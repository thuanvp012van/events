<?php

namespace Penguin\Component\Event;

use Penguin\Component\Container\BoundMethod;

class EventDispatcher implements EventDispatcherInterface
{
    protected array $listeners = [];

    protected array $sorted = [];

    public function __construct(protected ListenerProviderInterface $listenerProvider) {}

    public function dispatch(string|object $event, array $payload = []): array|null|false
    {
        $listeners = $this->listenerProvider->getListenersForEvent($event);
        if (is_object($event)) {
            array_unshift($payload, $event);
        }
        $responses = [];
        foreach ($listeners as $listener) {
            $response = BoundMethod::call($listener, $payload);
            if ($response === false) {
                return false;
            }

            if (!is_null($response)) {
                $responses[] = $response;
            }
        }
        return !empty($responses) ? $responses : null;
    }
}