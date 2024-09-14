<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2\GamesRecord;

final readonly class Games
{
    /**
     * @param Game[] $games
     */
    private function __construct(private array $games)
    {
    }

    public static function create(Game ...$games): self
    {
        return new self($games);
    }

    public function sumOfAllGameIds(): int
    {
        return \array_sum(
            \array_map(fn (Game $game) => $game->gameId, $this->games)
        );
    }
}
