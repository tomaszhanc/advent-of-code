<?php

declare(strict_types=1);

namespace Advent\Shared;

final class InvalidArgumentException extends \RuntimeException
{
    public static function because(string $pattern, string|int|float ...$parameters): self
    {
        return new self(\sprintf($pattern, ...$parameters));
    }
}
