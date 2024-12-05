<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day5\Model;

use Advent\Shared\Other\NumberList;
use Advent\Year2024\Day5\Model\PriorityList;
use Advent\Year2024\Day5\Model\PriorityListFactory;
use Advent\Year2024\Day5\Model\Rule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PriorityListTest extends TestCase
{
    #[Test]
    public function it_creates_priorities_list_from_the_rules(): void
    {
        $factory = new PriorityListFactory(
            new Rule(47, 53),
            new Rule(97, 13),
            new Rule(97, 61),
            new Rule(97, 47),
            new Rule(75, 29),
            new Rule(61, 13),
            new Rule(75, 53),
            new Rule(29, 13),
            new Rule(97, 29),
            new Rule(53, 29),
            new Rule(61, 53),
            new Rule(97, 53),
            new Rule(61, 29),
            new Rule(47, 13),
            new Rule(75, 47),
            new Rule(97, 75),
            new Rule(47, 61),
            new Rule(75, 61),
            new Rule(47, 29),
            new Rule(75, 13),
            new Rule(53, 13)
        );

        $this->assertEquals(
            new PriorityList(
                new NumberList(75, 47, 61, 53, 29)
            ),
            $factory->generateFor(new NumberList(29, 75, 53, 47, 61))
        );
    }
}
