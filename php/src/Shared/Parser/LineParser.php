<?php

declare(strict_types=1);

namespace Advent\Shared\Parser;

/**
 * @template-covariant TType
 */
interface LineParser
{
    /**
     * @return TType
     */
    public function parse(string $line): object;
}
