<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8\Model;

use Advent\Year2023\Day8\Model\Direction;
use Advent\Year2023\Day8\Model\Node;
use Advent\Year2023\Day8\Model\Nodes;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NodesTest extends TestCase
{
    #[Test]
    #[DataProvider('scenarios_for_starting_node')]
    public function it_takes_AAA_as_starting_node(Nodes $nodes): void
    {
        $this->assertEquals('AAA', $nodes->startNode()->name);
    }

    public static function scenarios_for_starting_node(): iterable
    {
        yield [
            new Nodes(
                new Node('AAA', 'BBB', 'CCC'),
                new Node('BBB', 'DDD', 'EEE'),
                new Node('EEE', 'AAA', 'BBB')
            ),
        ];

        yield [
            new Nodes(
                new Node('EEE', 'AAA', 'BBB'),
                new Node('AAA', 'BBB', 'CCC'),
                new Node('BBB', 'DDD', 'EEE')
            ),
        ];
    }

    #[Test]
    public function it_moves_from_one_node_to_another(): void
    {
        $nodes = new Nodes(
            new Node('AAA', 'BBB', 'CCC'),
            $nodeBBB = new Node('BBB', 'DDD', 'EEE'),
            $nodeCCC = new Node('CCC', 'EEE', 'FFF'),
        );

        $startNode = $nodes->startNode();

        $this->assertEquals($nodeBBB, $nodes->moveFrom($startNode, Direction::LEFT));
        $this->assertEquals($nodeCCC, $nodes->moveFrom($startNode, Direction::RIGHT));
    }
}
