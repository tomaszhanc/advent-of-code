<?php
declare(strict_types=1);

namespace Advent\Shared\Command;

final class Runner
{
    /** @param $callable $callable */
    private function __construct(
        private $callable,
        private array $attributes
    ) {
    }

    public static function create(callable $callable, mixed ...$attributes) : self
    {
        return new self([$callable], $attributes);
    }

    public function result() : mixed
    {
        return call_user_func($this->callable, ...$this->attributes);
    }
}
