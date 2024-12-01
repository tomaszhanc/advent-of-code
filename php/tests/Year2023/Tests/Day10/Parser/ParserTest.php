<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day10\Parser;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Year2023\Day10\Model\Pipe;
use Advent\Year2023\Day10\Model\Pipes;
use Advent\Year2023\Day10\Model\PipeType;
use Advent\Year2023\Day10\Parser\PipeParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    #[Test]
    public function it_parses_pipes(): void
    {
        $parser = new PipeParser();
        $input = new InMemoryInput(
            '..F7.',
            '.FJ|.',
            'SJ.L7',
            '|F--J',
            'LJ...',
        );

        $this->assertEquals(
            new Pipes(
                new Pipe(0, 2, PipeType::SOUTH_EAST),
                new Pipe(0, 3, PipeType::SOUTH_WEST),
                new Pipe(1, 1, PipeType::SOUTH_EAST),
                new Pipe(1, 2, PipeType::NORTH_WEST),
                new Pipe(1, 3, PipeType::NORTH_SOUTH),
                new Pipe(2, 0, PipeType::START),
                new Pipe(2, 1, PipeType::NORTH_WEST),
                new Pipe(2, 3, PipeType::NORTH_EAST),
                new Pipe(2, 4, PipeType::SOUTH_WEST),
                new Pipe(3, 0, PipeType::NORTH_SOUTH),
                new Pipe(3, 1, PipeType::SOUTH_EAST),
                new Pipe(3, 2, PipeType::WEST_EAST),
                new Pipe(3, 3, PipeType::WEST_EAST),
                new Pipe(3, 4, PipeType::NORTH_WEST),
                new Pipe(4, 0, PipeType::NORTH_EAST),
                new Pipe(4, 1, PipeType::NORTH_WEST),
            ),
            $parser->parse($input)
        );
    }
}
