<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Assertion\Lexer;

/**
 * @template T of \UnitEnum
 */
final readonly class SimplifiedToken
{
    /** @param T $type*/
    public function __construct(
        public string $value,
        public object $type
    ) {
    }

    public static function endOfLine(object $type): self
    {
        return new self(PHP_EOL, $type);
    }
}
