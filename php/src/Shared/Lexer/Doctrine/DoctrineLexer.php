<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer\Doctrine;

use Doctrine\Common\Lexer\AbstractLexer;

/**
 * @template T of \UnitEnum
 * @template-extends AbstractLexer<T, string>
 */
final class DoctrineLexer extends AbstractLexer
{
    // FIXME object dla patterns!!!
    public function __construct(
        private readonly array $patterns
    ) {
        // [Regex attribute object, enum type]
    }

    protected function getCatchablePatterns(): array
    {
        return array_map(
            fn (array $a) => $a[0]->toString(),
            $this->patterns
        );
    }

    protected function getNonCatchablePatterns(): array
    {
        return [];
    }

    /** @return T|null */
    protected function getType(string &$value): ?object
    {
        foreach ($this->patterns as [$regex, $type]) {
            if (\preg_match('/'.$regex->pattern.'/', $value)) {
                return $type;
            }
        }

        return null;
    }
}
