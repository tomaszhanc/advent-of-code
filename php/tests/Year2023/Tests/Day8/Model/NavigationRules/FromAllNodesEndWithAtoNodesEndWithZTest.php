<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8\Model\NavigationRules;

use Advent\Year2023\Day8\Model\NavigationRules\FromAllNodesEndWithAtoNodesEndWithZ;
use Advent\Year2023\Day8\Model\Node;
use Advent\Year2023\Day8\Model\Nodes;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class FromAllNodesEndWithAtoNodesEndWithZTest extends TestCase
{
    #[Test]
    public function it_returns_all_nodes_ending_with_A(): void
    {
        $rules = new FromAllNodesEndWithAtoNodesEndWithZ();
        $nodes = new Nodes(
            $node11A = new Node('11A', '11B', 'XXX'),
            new Node('11B', 'XXX', '11Z'),
            new Node('11Z', '11B', 'XXX'),
            $node22A = new Node('22A', '22B', 'XXX'),
            new Node('22B', '22C', '22C'),
            new Node('22C', '22Z', '22Z'),
            new Node('22Z', '22B', '22B'),
            new Node('XXX', 'XXX', 'XXX'),
        );

        $this->assertEquals(
            [$node11A, $node22A],
            iterator_to_array($rules->startingNodes($nodes))
        );
    }
}
