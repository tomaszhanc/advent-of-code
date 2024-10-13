<?php
declare(strict_types=1);

namespace Advent\Shared\Command;

final class Runners
{
    /** @var array<string, Runner[]> */
    private array $runners = [];

    public function add(string $name, Runner ...$runners) : self
    {
        $this->runners[$name] = $runners;
    }

    // fixme tituaj
    public function each() : void
    {

    }
}