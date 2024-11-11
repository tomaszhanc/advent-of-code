<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Doubles;

use Advent\Shared\Input\Input;

final readonly class InMemoryInput implements Input
{
    private array $lines;

    public function __construct(string ...$lines)
    {
        $this->lines = $lines;
    }

    public static function withContent(string $content): self
    {
        return new self(...explode("\n", $content));
    }

    public function lines(): \Iterator
    {
        return new \ArrayIterator($this->lines);
    }

    public function content(): string
    {
        return implode("\n", $this->lines);
    }
}
