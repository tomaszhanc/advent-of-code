<?php

declare(strict_types=1);

namespace AoC\Common\Doubles;

use AoC\Common\Parser;

final readonly class StdObjectParserStub implements Parser
{
    public function parse(string $input): object
    {
        $object = new \stdClass();
        $object->input = $input;

        return $object;
    }
}
