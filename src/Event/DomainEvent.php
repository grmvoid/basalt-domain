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

use Basalt\Domain\Aggregate\AggregateRootId;

abstract class DomainEvent
{
    private readonly DomainEventId $eventId;
    private readonly DomainEventOccurredOn $occurredOn;

    public function __construct(
        private readonly AggregateRootId $aggregateId,
        ?DomainEventId $eventId = null,
        ?DomainEventOccurredOn $occurredOn = null,
    ) {
        $this->eventId = $eventId ?? DomainEventId::generate();
        $this->occurredOn = $occurredOn ?? DomainEventOccurredOn::now();
    }

    /**
     * @param array<string, mixed> $payload
     */
    abstract public static function fromPayload(
        AggregateRootId $aggregateId,
        array $payload,
        DomainEventId $eventId,
        DomainEventOccurredOn $occurredOn,
    ): static;

    abstract public static function eventName(): string;

    /**
     * @return array<string, mixed>
     */
    abstract public function payload(): array;

    /**
     * @return array{
     *   eventName: string,
     *   aggregateId: string,
     *   payload: array<string,mixed>,
     *   eventId: string,
     *   occurredOn: string,
     * }
     */
    final public function toArray(): array
    {
        return [
            'eventName' => static::eventName(),
            'aggregateId' => (string) $this->aggregateId,
            'payload' => $this->payload(),
            'eventId' => (string) $this->eventId,
            'occurredOn' => $this->occurredOn->format(DATE_ATOM),
        ];
    }

    final public function aggregateId(): AggregateRootId
    {
        return $this->aggregateId;
    }

    final public function eventId(): DomainEventId
    {
        return $this->eventId;
    }

    final public function occurredOn(): DomainEventOccurredOn
    {
        return $this->occurredOn;
    }
}
