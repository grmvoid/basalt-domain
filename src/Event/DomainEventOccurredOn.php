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

use DateTimeImmutable;

final readonly class DomainEventOccurredOn
{
    public function __construct(
        private DateTimeImmutable $value
    ) {
    }

    public static function now(): self
    {
        return new self(new DateTimeImmutable());
    }

    public static function fromString(string $value): self
    {
        return new self(new DateTimeImmutable($value));
    }

    public function value(): DateTimeImmutable
    {
        return $this->value;
    }

    public function format(string $format = \DateTimeInterface::ATOM): string
    {
        return $this->value->format($format);
    }
}
