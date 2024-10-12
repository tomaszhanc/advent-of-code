<?php

declare(strict_types=1);

namespace Advent\Shared\Parser;

/**
 * @template T of object
 */
interface LineParser
{
    /**
     * @return T
     */
    public function parse(string $line, int $lineNumber): object;
}
