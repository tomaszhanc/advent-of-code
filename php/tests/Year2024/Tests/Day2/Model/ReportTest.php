<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day2\Model;

use Advent\Year2024\Day2\Model\Report;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ReportTest extends TestCase
{
    #[Test]
    #[DataProvider('safe_reports')]
    public function it_confirms_report_is_safe(int ...$numbers): void
    {
        $this->assertTrue(new Report(...$numbers)->isSafe());
    }

    public static function safe_reports(): iterable
    {
        yield [7, 6, 4, 2, 1];
        yield [1, 3, 6, 7, 9];

    }

    #[Test]
    #[DataProvider('unsafe_reports')]
    public function it_confirms_report_is_unsafe(int ...$numbers): void
    {
        $this->assertFalse(new Report(...$numbers)->isSafe());
    }

    public static function unsafe_reports(): iterable
    {
        yield [1, 2, 7, 8, 9];
        yield [9, 7, 6, 2, 1];
        yield [1, 3, 2, 4, 5];
        yield [8, 6, 4, 4, 1];
    }

    #[Test]
    #[DataProvider('reports_with_single_bad_level')]
    public function it_confirms_report_with_single_bad_level_is_safe(int ...$numbers): void
    {
        $this->assertTrue(new Report(...$numbers)->isSafeWithAtMostSingleBadLevel());
    }

    public static function reports_with_single_bad_level(): iterable
    {
        yield [7, 6, 4, 2, 1];
        yield [1, 3, 2, 4, 5];
        yield [8, 6, 4, 4, 1];
        yield [1, 3, 6, 7, 9];

        yield [99, 10, 13, 16, 17];
        yield [10, 99, 13, 16, 17];
        yield [10, 13, 99, 16, 17];
        yield [10, 13, 16, 99, 17];
        yield [10, 13, 16, 17, 99];

        yield [0, 10, 13, 16, 17];
        yield [10, 0, 13, 16, 17];
        yield [10, 13, 0, 16, 17];
        yield [10, 13, 16, 0, 17];
        yield [10, 13, 16, 17, 0];

        yield [84, 83, 80, 81, 80];
    }

    #[Test]
    #[DataProvider('reports_more_than_single_bad_level')]
    public function it_confirms_report_with_more_than_single_bad_level_is_unsafe(int ...$numbers): void
    {
        $this->assertFalse(new Report(...$numbers)->isSafeWithAtMostSingleBadLevel());
    }

    public static function reports_more_than_single_bad_level(): iterable
    {
        yield [1, 2, 7, 8, 9];
        yield [9, 7, 6, 2, 1];
        yield [1, 2, 0, 4, 0];

        yield [99, 10, 13, 16, 17, 99];
        yield [10, 99, 13, 16, 17, 99];
        yield [10, 13, 99, 16, 17, 99];
        yield [10, 13, 16, 99, 17, 99];
        yield [10, 13, 16, 17, 99, 99];

        yield [0, 0, 10, 13, 16, 17];
        yield [0, 10, 0, 13, 16, 17];
        yield [0, 10, 13, 0, 16, 17];
        yield [0, 10, 13, 16, 0, 17];
        yield [0, 10, 13, 16, 17, 0];
    }
}
