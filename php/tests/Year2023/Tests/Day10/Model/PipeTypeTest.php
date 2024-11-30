<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day10\Model;

use Advent\Shared\Grid\Direction;
use Advent\Year2023\Day10\Model\PipeType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PipeTypeTest extends TestCase
{
    #[Test]
    #[DataProvider('pipe_directions')]
    public function it_return_pipe_type_directions(PipeType $type, Direction ...$directions): void
    {
        $this->assertEqualsCanonicalizing($directions, $type->accessibleDirections());
    }

    public static function pipe_directions(): iterable
    {
        yield [PipeType::NORTH_SOUTH, Direction::UP, Direction::DOWN];
        yield [PipeType::NORTH_EAST, Direction::UP, Direction::RIGHT];
        yield [PipeType::NORTH_WEST, Direction::UP, Direction::LEFT];
        yield [PipeType::SOUTH_EAST, Direction::DOWN, Direction::RIGHT];
        yield [PipeType::SOUTH_WEST, Direction::DOWN, Direction::LEFT];
        yield [PipeType::EAST_WEST, Direction::RIGHT, Direction::LEFT];
        yield [PipeType::START, Direction::UP, Direction::DOWN, Direction::RIGHT, Direction::LEFT];
    }
}
