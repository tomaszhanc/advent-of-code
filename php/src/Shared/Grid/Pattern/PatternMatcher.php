<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Pattern;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Grid;
use Advent\Shared\Grid\Location;
use Advent\Shared\InvalidArgumentException;

final readonly class PatternMatcher
{
    private string $expectedHash;

    /** @var Location[] */
    private array $expectedLocations;

    /** @param Grid<PatternCell> $pattern */
    public function __construct(
        Grid $pattern
    ) {
        $hashItems = [];
        $patternLocations = [];

        foreach ($pattern->allCells() as $patternCell) {
            if (!$patternCell instanceof PatternCell) {
                throw InvalidArgumentException::because('Expected Pattern, got %s', get_class($patternCell));
            }

            if ($patternCell->canBeAny()) {
                continue;
            }

            $hashItems[] = $this->generateHashItem($patternCell);
            $patternLocations[] = $patternCell->location();
        }

        $this->expectedHash = $this->generateHash($hashItems);
        $this->expectedLocations = $patternLocations;
    }

    public function matchedBy(Grid $grid): bool
    {
        $hashItems = [];

        foreach ($this->expectedLocations as $location) {
            $cell = $grid->getCellAt($location);
            $hashItems[] = $this->generateHashItem($cell);
        }

        return $this->expectedHash === $this->generateHash($hashItems);
    }

    private function generateHashItem(Cell $cell): string
    {
        return sprintf('[%s=%s]', $cell->location()->toString(), $cell->value());
    }

    private function generateHash(array $hashItems): string
    {
        sort($hashItems);
        return implode('', $hashItems);
    }
}
