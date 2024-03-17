<?php

namespace Penguin\Component\Event;

interface EventSubscriberInterface
{
    public function subscribe(EventDispatcherInterface $dispatcher): void;
}