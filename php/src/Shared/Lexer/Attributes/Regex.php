<?php

namespace Advent\Shared\Lexer\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT | Attribute::IS_REPEATABLE)]
class Regex
{
    public function __construct(
        public readonly string $pattern,
        public readonly bool $positiveLookahead = false
    ) {
    }

    public function toString(): string
    {
        return $this->positiveLookahead
            ? sprintf('?=(%s)', $this->pattern)
            : $this->pattern;
    }
}
