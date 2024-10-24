<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day3\Model;

use Advent\Year2023\Day3\Model\PartNumber;
use Advent\Year2023\Day3\Model\PartNumbers;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PartNumbersTest extends TestCase
{
    #[Test]
    public function it_sums_all_part_numbers(): void
    {
        $partNumbers = new PartNumbers(
            new PartNumber(1),
            new PartNumber(2),
            new PartNumber(3),
        );

        $this->assertEquals(6, $partNumbers->sum());
    }
}
