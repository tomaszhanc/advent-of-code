<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit;

use Advent\Year2023\Day3;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class Day3Test extends TestCase
{
    private Day3 $day3;

    private string $engineSchematicFilePath;

    protected function setUp(): void
    {
        $this->day3 = Day3::create();
        $this->engineSchematicFilePath = __DIR__ . '/../Resources/day3.txt';
    }

    #[Test]
    public function part_one_(): void
    {

    }

    #[Test]
    public function part_two_(): void
    {

    }
}
