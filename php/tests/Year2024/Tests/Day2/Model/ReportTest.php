<?php
declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day2\Model;

use Advent\Year2024\Day2\Model\Report;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ReportTest extends TestCase
{
    #[Test]
    public function it_checks_if_report_is_safe(): void
    {
//        $this->assertTrue(new Report(7, 6, 4, 2, 1)->isSafe());
//        $this->assertFalse(new Report(1, 2, 7, 8, 9)->isSafe());
//        $this->assertFalse(new Report(9, 7, 6, 2, 1)->isSafe());
//        $this->assertFalse(new Report(1, 3, 2, 4, 5)->isSafe());
//        $this->assertFalse(new Report(8, 6, 4, 4, 1)->isSafe());
//        $this->assertTrue(new Report(1, 3, 6, 7, 9)->isSafe());

        $this->assertTrue(new Report(1, 4, 7, 8, 9, 7)->isSafe());
    }
}