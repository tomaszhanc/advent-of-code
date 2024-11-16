<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Math;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function Advent\Shared\Math\lowestCommonMultiple;

final class FunctionsTest extends TestCase
{
    #[Test]
    #[DataProvider('lowest_common_multiple')]
    public function it_calculates_lowest_common_multiple(array $numbers, int $expectedLCM): void
    {
        $this->assertEquals($expectedLCM, lowestCommonMultiple(...$numbers));
    }

    public static function lowest_common_multiple(): iterable
    {
        yield [[2,5], 10];
        yield [[4,5], 20];
        yield [[6,15], 30];
        yield [[12,21], 84];
        yield [[60,90], 180];

        yield [[2,5,6], 30];
    }
}
