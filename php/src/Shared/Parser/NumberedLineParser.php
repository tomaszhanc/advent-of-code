<?php

declare(strict_types=1);

namespace Advent\Shared\Parser;

/**
 * @template-covariant TType
 */
interface NumberedLineParser
{
    /**
     * @return TType
     */
    public function parse(int $lineNumber, string $line): object;
}
