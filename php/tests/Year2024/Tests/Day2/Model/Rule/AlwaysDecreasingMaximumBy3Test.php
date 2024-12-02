<?php
declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day2\Model\Rule;

use Advent\Year2024\Day2\Model\Rule\AlwaysDecreasingMaximumBy3;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AlwaysDecreasingMaximumBy3Test extends TestCase
{
    #[Test]
    #[DataProvider('valid_values')]
    public function it_satisfies(int $current, $next): void
    {
        $rule = new AlwaysDecreasingMaximumBy3();

        $this->assertTrue($rule->isSatisfied($current, $next));
    }

    public static function valid_values() : iterable
    {
        yield '-1' => [10, 9];
        yield '-2' => [10, 8];
        yield '-3' => [10, 7];
    }

    #[Test]
    #[DataProvider('invalid_values')]
    public function it_not_satisfies(int $current, $next): void
    {
        $rule = new AlwaysDecreasingMaximumBy3();

        $this->assertFalse($rule->isSatisfied($current, $next));
    }

    public static function invalid_values() : iterable
    {
        yield '0' => [10, 10];

        yield '-4' => [10, 6];
        yield '-5' => [10, 5];

        yield '+1' => [10, 11];
        yield '+2' => [10, 12];
        yield '+3' => [10, 13];
    }
}
