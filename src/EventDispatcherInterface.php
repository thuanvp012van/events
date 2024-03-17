<?php

namespace Penguin\Component\Event;

interface EventDispatcherInterface
{
    public function dispatch(string|object $event): void;
}
