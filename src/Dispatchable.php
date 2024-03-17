<?php

namespace Penguin\Component\Event;

use Penguin\Component\Event\EventDispatcherInterface;

trait Dispatchable
{
    public static function dispatch(mixed ...$params): void
    {
        service(EventDispatcherInterface::class)
            ->dispatch(new static(...$params));
    }

    public static function dispatchIf(bool $condition, mixed ...$params): void
    {
        if ($condition) {
            static::dispatch(...$params);
        }
    }

    public static function dispatchUnless(bool $condition, mixed ...$params): void
    {
        if (!$condition) {
            static::dispatch(...$params);
        }
    }
}