<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer;

final class RuntimeException extends \RuntimeException
{
    public static function because(string $pattern, string|int|float ...$parameters): self
    {
        return new self(sprintf($pattern, ...$parameters));
    }

    public static function unexpectedToken(\UnitEnum $expectedToken, \UnitEnum $receivedToken, string|int $value): self
    {
        return self::because(
            'Expected "%s" token, got "%s" token with value "%s"',
            $expectedToken->name,
            $receivedToken->name,
            $value
        );
    }
}
