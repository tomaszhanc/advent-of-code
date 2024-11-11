<?php

declare(strict_types=1);

namespace Advent\Shared\Input;

final class RuntimeException extends \RuntimeException
{
    public static function because(string $pattern, string|int|float ...$parameters): self
    {
        return new self(\sprintf($pattern, ...$parameters));
    }
}
