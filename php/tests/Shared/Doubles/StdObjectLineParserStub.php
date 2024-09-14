<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Doubles;

use Advent\Shared\Parser\LineParser;

final readonly class StdObjectLineParserStub implements LineParser
{
    public function parse(string $line): object
    {
        $object = new \stdClass();
        $object->input = $line;

        return $object;
    }
}
