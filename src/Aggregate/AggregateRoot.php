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

namespace Basalt\Domain\Aggregate;

interface AggregateRoot
{
    public function getAggregateRootId(): AggregateRootId;

    /**
     * @return \Basalt\Domain\Event\DomainEvent[]
     */
    public function getUncommittedEvents(): array;
}
