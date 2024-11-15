<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8\Model;

use Advent\Year2023\Day8\Model\Instructions;
use Advent\Year2023\Day8\Model\Direction;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class InstructionsTest extends TestCase
{
    #[Test]
    public function it_iterates_in_infinite_loop(): void
    {
        $instructions = new Instructions(Direction::LEFT, Direction::RIGHT);

        $moves = [];
        for ($i = 1; $i <= 5; $i++) {
            $moves[] = $instructions->current();
            $instructions->next();
        }

        $this->assertEquals(
            [
                Direction::LEFT,
                Direction::RIGHT,
                Direction::LEFT,
                Direction::RIGHT,
                Direction::LEFT,
            ],
            $moves
        );
    }
}
