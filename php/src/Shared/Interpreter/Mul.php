<?php

declare(strict_types=1);

namespace Advent\Shared\Interpreter;

final readonly class Mul implements Expression
{
    public function __construct(
        private Number $left,
        private Number $right
    ) {
    }

    public static function fromInt(int $left, int $right): self
    {
        return new self(new Number($left), new Number($right));
    }

    public function interpret(): int
    {
        return $this->left->interpret() * $this->right->interpret();
    }
}
