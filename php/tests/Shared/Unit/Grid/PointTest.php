<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Direction;
use Advent\Shared\Grid\Location;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PointTest extends TestCase
{
    #[Test]
    public function it_returns_closest_neighbours_in_all_directions(): void
    {
        $point = new Location(x: 1, y: 5);

        $this->assertEquals(new Location(x: 0, y: 4), $point->neighbourAt(Direction::UP_LEFT));
        $this->assertEquals(new Location(x: 1, y: 4), $point->neighbourAt(Direction::UP));
        $this->assertEquals(new Location(x: 2, y: 4), $point->neighbourAt(Direction::UP_RIGHT));
        $this->assertEquals(new Location(x: 0, y: 5), $point->neighbourAt(Direction::LEFT));
        $this->assertEquals(new Location(x: 2, y: 5), $point->neighbourAt(Direction::RIGHT));
        $this->assertEquals(new Location(x: 0, y: 6), $point->neighbourAt(Direction::DOWN_LEFT));
        $this->assertEquals(new Location(x: 1, y: 6), $point->neighbourAt(Direction::DOWN));
        $this->assertEquals(new Location(x: 2, y: 6), $point->neighbourAt(Direction::DOWN_RIGHT));
    }
}
