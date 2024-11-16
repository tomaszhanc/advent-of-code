<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8\Model;

use Advent\Year2023\Day8\Model\Node;
use Advent\Year2023\Day8\Model\Nodes;
use Advent\Year2023\Day8\Model\Direction;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class NodeTest extends TestCase
{
    #[Test]
    public function it_moves_from_one_node_to_another(): void
    {
        $nodes = new Nodes(
            $nodeAAA = new Node('AAA', 'BBB', 'CCC'),
            $nodeBBB = new Node('BBB', 'DDD', 'EEE'),
            $nodeCCC = new Node('CCC', 'EEE', 'FFF'),
        );

        $this->assertEquals($nodeBBB, $nodeAAA->move(Direction::LEFT, $nodes));
        $this->assertEquals($nodeCCC, $nodeAAA->move(Direction::RIGHT, $nodes));
    }
}
