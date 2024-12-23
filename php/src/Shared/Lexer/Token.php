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

    public function isA(\UnitEnum $type): bool
    {
        return $this->type === $type;
    }

    public function isNotA(\UnitEnum $type): bool
    {
        return !$this->isA($type);
    }

    public function assertIsA(\UnitEnum $type): void
    {
        if ($this->isNotA($type)) {
            throw RuntimeException::unexpectedToken($type, $this->type, $this->value);
        }
    }
}
