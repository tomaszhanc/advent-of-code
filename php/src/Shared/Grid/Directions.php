<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

final readonly class Directions implements \IteratorAggregate
{
    /** @var Direction[] */
    private array $directions;

    public function __construct(Direction ...$direction)
    {
        $this->directions = $direction;
    }

    public static function orthogonalDirections(): self
    {
        return new self(Direction::UP, Direction::DOWN, Direction::LEFT, Direction::RIGHT);
    }

    public static function nonOrthogonalDirections(): self
    {
        return new self(Direction::UP_LEFT, Direction::UP_RIGHT, Direction::DOWN_RIGHT, Direction::DOWN_LEFT);
    }

    public static function allDirections(): self
    {
        return new self(
            Direction::UP_LEFT,
            Direction::UP,
            Direction::UP_RIGHT,
            Direction::RIGHT,
            Direction::DOWN_RIGHT,
            Direction::DOWN,
            Direction::DOWN_LEFT,
            Direction::LEFT
        );
    }

    public function has(Direction $direction): bool
    {
        foreach ($this->directions as $next) {
            if ($next->equals($direction)) {
                return true;
            }
        }

        return false;
    }

    /** @return Direction[] */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->directions);
    }
}
