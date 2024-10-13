<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit;

use Advent\Year2023\Day3;
use PHPUnit\Framework\TestCase;

final class Day3Todo extends TestCase
{
    private Day3 $day3;

    private string $engineSchematicFilePath;

    protected function setUp(): void
    {
        $this->day3 = Day3::create();
        $this->engineSchematicFilePath = __DIR__ . '/../../../resources/day3.txt';
    }

    public function part_one_(): void
    {

    }

    public function part_two_(): void
    {

    }
}
