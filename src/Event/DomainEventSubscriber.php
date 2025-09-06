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

interface DomainEventSubscriber
{
    /**
     */
    public function handle(DomainEvent $event): void;

    /**
     */
    public function isSubscribedTo(DomainEvent $event): bool;

    /**
     * @return class-string<\Basalt\Domain\Event\DomainEvent>[]
     */
    public function subscribeTo(): array;
}
