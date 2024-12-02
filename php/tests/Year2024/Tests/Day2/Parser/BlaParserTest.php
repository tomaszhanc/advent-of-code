<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day2\Parser;

use Advent\Year2024\Day2\Parser\ReportParser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class BlaParserTest extends TestCase
{
    #[Test]
    #[DataProvider('lines')]
    public function it_parses_(string $line, $expected): void
    {
        $parser = new ReportParser();

        $this->assertEquals($expected, $parser->parse($line));
    }

    public static function lines(): iterable
    {

    }

}
