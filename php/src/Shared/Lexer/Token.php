<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer;

/**
 * @template T of \UnitEnum
 */
final readonly class Token
{
    /** @param T $type*/
    public function __construct(
        public string $value,
        public ?object $type,
        public int $position,
    ) {
    }
}
