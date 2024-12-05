<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Node;

use Advent\Shared\Graph\Node;

final readonly class IntegerNode implements Node
{
    public function __construct(
        public int $id
    ) {
    }

    public function id(): string
    {
        return (string) $this->id;
    }
}
