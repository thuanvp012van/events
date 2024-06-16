<?php

namespace Penguin\Component\Event;

class NullDispatcher implements EventDispatcherInterface
{
    public function __construct(protected ListenerProviderInterface $listenerProvider) {}

    public function dispatch(string|object $event, array $payload = []): array|null|false
    {
        return null;
    }
}