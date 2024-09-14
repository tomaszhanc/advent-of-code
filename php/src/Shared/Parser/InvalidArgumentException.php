<?php

declare(strict_types=1);

namespace Advent\Shared\Parser;

final class InvalidArgumentException extends \InvalidArgumentException
{
    public static function because(string $pattern, string|int|float ...$parameters): self
    {
        return new self(sprintf($pattern, ...$parameters));
    }
}
