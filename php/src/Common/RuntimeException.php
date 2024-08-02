<?php

declare(strict_types=1);

namespace AoC\Common;

use Doctrine\Common\Lexer\Token;

final class RuntimeException extends \RuntimeException
{
    public static function because(string $pattern, string|int|float ...$parameters): self
    {
        return new self(\sprintf($pattern, ...$parameters));
    }

    public static function invalidToken(string $message, ?Token $invalidToken): self
    {
        return new self($message . " Given: " . $invalidToken->value ?? "<NULL>");
    }

    public static function unexpected(string $message): self
    {
        return new self("Unexpected behavior! " . $message);
    }
}
