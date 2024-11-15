<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8\Model;

use Advent\Year2023\Day8\Model\Instructions;
use Advent\Year2023\Day8\Model\Map;
use Advent\Year2023\Day8\Model\Direction;
use Advent\Year2023\Day8\Model\Node;
use Advent\Year2023\Day8\Model\Nodes;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    #[Test]
    #[DataProvider('maps')]
    public function it_returns_number_of_steps_to_reach_the_final_destination(Map $map, int $expectedNumberOfSteps): void
    {
        $this->assertEquals($expectedNumberOfSteps, $map->numberOfStepsToReachFinalDestination());
    }

    public static function maps(): iterable
    {
        yield [
            new Map(
                new Instructions(Direction::RIGHT, Direction::LEFT),
                new Nodes(
                    new Node('AAA', 'BBB', 'CCC'),
                    new Node('BBB', 'DDD', 'CCC'),
                    new Node('CCC', 'ZZZ', 'GGG'),
                    new Node('DDD', 'DDD', 'DDD'),
                    new Node('EEE', 'EEE', 'EEE'),
                    new Node('GGG', 'GGG', 'GGG'),
                    new Node('ZZZ', 'ZZZ', 'ZZZ'),
                )
            ),
            2,
        ];

        yield [
           new Map(
               new Instructions(Direction::LEFT, Direction::LEFT, Direction::RIGHT),
               new Nodes(
                   new Node('AAA', 'BBB', 'BBB'),
                   new Node('BBB', 'AAA', 'ZZZ'),
                   new Node('ZZZ', 'ZZZ', 'ZZZ'),
               )
           ),
           6,
        ];
    }
}
