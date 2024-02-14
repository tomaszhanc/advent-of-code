<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests;

use AoC\Year2023\Day3;
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

    public function test_part_one_(): void
    {

    }

    public function test_part_two_(): void
    {

    }
}
