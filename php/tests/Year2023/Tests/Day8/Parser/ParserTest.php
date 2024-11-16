<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8\Parser;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Year2023\Day8\Model\Nodes;
use Advent\Year2023\Day8\Model\Direction;
use Advent\Year2023\Day8\Model\Instructions;
use Advent\Year2023\Day8\Model\Map;
use Advent\Year2023\Day8\Model\NavigationRules;
use Advent\Year2023\Day8\Parser\Parser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    #[Test]
    public function it_parses_a_map(): void
    {
        $parser = new Parser();
        $input = new InMemoryInput(
            'LRLLR',
            '',
            'AAA = (AAR, BBL)',
            'BBL = (DDD, EEE)'
        );

        $this->assertEquals(
            new Map(
                new Instructions(
                    Direction::LEFT,
                    Direction::RIGHT,
                    Direction::LEFT,
                    Direction::LEFT,
                    Direction::RIGHT
                ),
                new Nodes(
                    new Node('AAA', 'AAR', 'BBL'),
                    new Node('BBL', 'DDD', 'EEE'),
                )
            ),
            $parser->parse($input->content())
        );
    }
}
