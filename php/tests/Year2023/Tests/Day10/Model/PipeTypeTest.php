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
    #[DataProvider('pipe_is_for_a_given_direction')]
    public function it_checks_that_pipe_is_for_a_given_direction(PipeType $type, Direction ...$directions): void
    {
        $this->assertEqualsCanonicalizing($directions, $type->directions());

        foreach ($directions as $direction) {
            $this->assertTrue($type->in($direction));
        }
    }

    public static function pipe_is_for_a_given_direction(): iterable
    {
        yield [PipeType::NORTH_SOUTH, Direction::UP, Direction::DOWN];
        yield [PipeType::NORTH_EAST, Direction::UP, Direction::RIGHT];
        yield [PipeType::NORTH_WEST, Direction::UP, Direction::LEFT];
        yield [PipeType::SOUTH_EAST, Direction::DOWN, Direction::RIGHT];
        yield [PipeType::SOUTH_WEST, Direction::DOWN, Direction::LEFT];
        yield [PipeType::EAST_WEST, Direction::RIGHT, Direction::LEFT];
        yield [PipeType::START, Direction::UP, Direction::DOWN, Direction::RIGHT, Direction::LEFT];
    }

    #[Test]
    #[DataProvider('pipe_is_not_for_a_given_direction')]
    public function it_checks_that_pipe_is_not_for_a_given_direction(PipeType $type, Direction ...$directions): void
    {
        foreach ($directions as $direction) {
            $this->assertFalse($type->in($direction));
        }
    }

    public static function pipe_is_not_for_a_given_direction(): iterable
    {
        yield [PipeType::NORTH_SOUTH, Direction::RIGHT, Direction::LEFT];
        yield [PipeType::NORTH_EAST, Direction::DOWN, Direction::LEFT];
        yield [PipeType::NORTH_WEST, Direction::DOWN, Direction::RIGHT];
        yield [PipeType::SOUTH_EAST, Direction::UP, Direction::LEFT];
        yield [PipeType::SOUTH_WEST, Direction::UP, Direction::RIGHT];
        yield [PipeType::EAST_WEST, Direction::UP, Direction::DOWN];
    }
}
