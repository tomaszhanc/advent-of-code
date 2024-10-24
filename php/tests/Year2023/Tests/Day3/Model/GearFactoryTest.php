<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day3\Model;

use Advent\Year2023\Day3\Model\Element\Elements;
use Advent\Year2023\Day3\Model\Element\NumberElement;
use Advent\Year2023\Day3\Model\Element\SymbolElement;
use Advent\Year2023\Day3\Model\Gear;
use Advent\Year2023\Day3\Model\Gears;
use Advent\Year2023\Day3\Model\GearsFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GearFactoryTest extends TestCase
{
    #[Test]
    public function it_creates_gears_from_elements(): void
    {
        $gearFactory = new GearsFactory();

        $this->assertEquals(
            new Gears(
                new Gear(467, 35)
            ),
            $gearFactory->createFor(
                new Elements(
                    new NumberElement(lineNumber: 0, position: 0, number: 467),
                    new NumberElement(lineNumber: 0, position: 5, number: 114),
                    new SymbolElement(lineNumber: 1, position: 3, symbol: '*'),
                    new NumberElement(lineNumber: 2, position: 2, number: 35),
                    new NumberElement(lineNumber: 2, position: 6, number: 633),
                )
            )
        );
    }
}
