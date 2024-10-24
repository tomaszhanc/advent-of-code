<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit;

use Advent\Year2023\Day3;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class Day3Test extends TestCase
{
    private const string ENGINE_SCHEMATIC_FILE_PATH = __DIR__ . '/../../../resources/day3.txt';

    #[Test]
    public function part_one_sum_all_part_numbers(): void
    {
        $this->assertEquals(
            544433,
            Day3::create()->partOne_sumAllPartNumbers(self::ENGINE_SCHEMATIC_FILE_PATH)
        );
    }
}
