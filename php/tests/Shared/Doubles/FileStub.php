<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Doubles;

use Advent\Shared\Filesystem\File;

final readonly class FileStub implements File
{
    private array $lines;

    public function __construct(string ...$lines)
    {
        $this->lines = $lines;
    }

    public function lines(): iterable
    {
        return $this->lines;
    }
}
