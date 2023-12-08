<?php

declare(strict_types=1);

namespace AoC\Common;

final class InvalidArgumentException extends \InvalidArgumentException
{
    public static function because(string $pattern, mixed ...$parameters): self
    {
        return new self(sprintf($pattern, ...$parameters));
    }
}
