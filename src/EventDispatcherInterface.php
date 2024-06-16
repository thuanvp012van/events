<?php

namespace Penguin\Component\Event;

interface EventDispatcherInterface
{
    public function dispatch(string|object $event, array $payload = []): array|null|false;
}
