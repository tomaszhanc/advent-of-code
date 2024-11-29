<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

final class NodeId
{
    public function __construct(
        private string $id
    ) {
    }

    public function toString(): string
    {
        return $this->id;
    }
}
