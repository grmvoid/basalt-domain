<?php

declare(strict_types=1);

/*
 * This file is part of the grmvoid/basalt-events.
 *
 * Copyright (C) Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Basalt\Domain\Event;

class DomainEventDispatcher
{
    /** @var array<class-string<\Basalt\Domain\Event\DomainEvent>, list<\Basalt\Domain\Event\DomainEventSubscriber>> $subscribers */
    private array $subscribers = [];

    /**
     * @param iterable<\Basalt\Domain\Event\DomainEventSubscriber> $subscribers
     */
    public function __construct(iterable $subscribers = [])
    {
        foreach ($subscribers as $subscriber) {
            $this->addSubscriber($subscriber);
        }
    }

    public function addSubscriber(DomainEventSubscriber $subscriber): void
    {
        foreach ($subscriber->subscribeTo() as $eventClass) {
            $this->subscribers[$eventClass][] = $subscriber;
        }
    }

    public function dispatch(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $subscribers = $this->subscribersFor($event);

            foreach ($subscribers as $subscriber) {
                if (!$subscriber->isSubscribedTo($event)) {
                    continue;
                }

                $subscriber->handle($event);
            }
        }
    }

    /**
     * @return list<\Basalt\Domain\Event\DomainEventSubscriber>
     */
    private function subscribersFor(DomainEvent $event): array
    {
        return $this->subscribers[$event::class] ?? [];
    }
}
