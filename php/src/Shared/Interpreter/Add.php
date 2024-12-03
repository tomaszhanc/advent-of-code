<?php

declare(strict_types=1);

namespace Advent\Shared\Interpreter;

final readonly class Add implements Expression
{
    /** @var Expression[] */
    private array $expressions;

    public function __construct(
        Expression ...$expressions,
    ) {
        $this->expressions = $expressions;
    }

    public function interpret(): int
    {
        $result = 0;

        foreach ($this->expressions as $expression) {
            $result += $expression->interpret();
        }

        return $result;
    }
}
