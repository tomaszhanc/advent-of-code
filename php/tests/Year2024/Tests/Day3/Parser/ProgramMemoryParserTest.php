<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day3\Parser;

use Advent\Shared\Interpreter\Mul;
use Advent\Year2024\Day3\Parser\ProgramMemoryParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ProgramMemoryParserTest extends TestCase
{
    #[Test]
    public function it_parses_all_mul_expressions(): void
    {
        $parser = new ProgramMemoryParser();

        $this->assertEquals(
            [
                Mul::fromInt(2, 4),
                Mul::fromInt(5, 5),
                Mul::fromInt(11, 8),
                Mul::fromInt(8, 5),
            ],
            $parser->parseAllMulExpressions('xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))')
        );
    }

    #[Test]
    public function it_parses_only_enabled_mul_expressions(): void
    {
        $parser = new ProgramMemoryParser();

        $this->assertEquals(
            [
                Mul::fromInt(2, 4),
                Mul::fromInt(8, 5),
            ],
            $parser->parseOnlyEnabledMulExpressions("xmul(2,4)%&mul[3,7]!@^don't()_mul(5,5)+mul(32,64]then(mul(11,8)do()mul(8,5))")
        );
    }
}
