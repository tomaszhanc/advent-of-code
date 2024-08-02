<?php

declare(strict_types=1);

namespace AoC\Common\Doubles;

use AoC\Common\LineParser;

final readonly class StdObjectLineParserStub implements LineParser
{
    public function parse(string $line): object
    {
        $object = new \stdClass();
        $object->input = $line;

        return $object;
    }
}
