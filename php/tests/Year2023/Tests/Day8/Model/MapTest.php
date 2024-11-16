<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8\Model;

use Advent\Year2023\Day8\Model\Node;
use Advent\Year2023\Day8\Model\Nodes;
use Advent\Year2023\Day8\Model\Direction;
use Advent\Year2023\Day8\Model\Instructions;
use Advent\Year2023\Day8\Model\Map;
use Advent\Year2023\Day8\Model\NavigationRules\FromNodeAAAToNodeZZZ;
use Advent\Year2023\Day8\Model\NavigationRules\FromAllNodesEndWithAToNodesEndWithZ;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    #[Test]
    #[DataProvider('scenarios_for_going_from_AAA_to_ZZZ')]
    public function it_returns_number_of_steps_to_move_from_AAA_to_ZZZ(Map $map, int $expectedNumberOfSteps): void
    {
        $this->assertEquals($expectedNumberOfSteps, $map->numberOfSteps(new FromNodeAAAToNodeZZZ()));
    }

    public static function scenarios_for_going_from_AAA_to_ZZZ(): iterable
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

    #[Test]
    public function it_returns_number_of_steps_to_move_from_all_xxA_to_all_xxxZ_simultaneously(): void
    {
        $map = new Map(
            new Instructions(Direction::LEFT, Direction::RIGHT),
            new Nodes(
                new Node('11A', '11B', 'XXX'),
                new Node('11B', 'XXX', '11Z'),
                new Node('11Z', '11B', 'XXX'),
                new Node('22A', '22B', 'XXX'),
                new Node('22B', '22C', '22C'),
                new Node('22C', '22Z', '22Z'),
                new Node('22Z', '22B', '22B'),
                new Node('XXX', 'XXX', 'XXX'),
            )
        );

        $this->assertEquals(6, $map->numberOfSteps(new FromAllNodesEndWithAToNodesEndWithZ()));
    }
}
