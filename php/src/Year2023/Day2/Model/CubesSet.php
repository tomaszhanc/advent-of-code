<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2\Model;

final readonly class CubesSet
{
    /**
     * @param Cubes[] $cubes
     */
    private function __construct(public array $cubes)
    {
    }

    public static function of(Cubes ...$cubes): self
    {
        return new self($cubes);
    }

    public static function empty(): self
    {
        return new self([]);
    }

    public function quantityOf(Color $color): int
    {
        return $this->getCubesOf($color)->quantity ?? 0;
    }

    public function replaceWith(Cubes $cubes): self
    {
        return self::of(
            $cubes,
            ...\array_filter($this->cubes, fn (Cubes $theCubes) => $theCubes->color !== $cubes->color)
        );
    }

    public function power(): int
    {
        if (empty($this->cubes)) {
            return 0;
        }

        return \array_reduce(
            $this->cubes,
            fn (int $total, Cubes $cubes) => $total * $cubes->quantity,
            1
        );
    }

    private function getCubesOf(Color $color): ?Cubes
    {
        foreach ($this->cubes as $cube) {
            if ($cube->color === $color) {
                return $cube;
            }
        }

        return null;
    }
}
