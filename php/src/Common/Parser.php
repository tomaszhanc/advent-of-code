<?php

declare(strict_types=1);

namespace AoC\Common;

/**
 * @template-covariant TType
 */
interface Parser
{
    /**
     * @return TType
     */
    public function parse(string $input) : object;
}
