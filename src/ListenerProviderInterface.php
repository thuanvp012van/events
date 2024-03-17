<?php

namespace Penguin\Component\Event;

use Psr\EventDispatcher\ListenerProviderInterface as PsrListenerProviderInterface;

interface ListenerProviderInterface
{
    public function getListenersForEvent(string|object $event): array;

    public function addListener(string $event, callable $callable): static;

    public function clearListeners(string $event): void;
}