<?php

declare(strict_types=1);

namespace Advent\Shared\Command\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Menu
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly array $parts,
    ) {
    }
}
