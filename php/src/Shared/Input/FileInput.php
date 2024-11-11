<?php

declare(strict_types=1);

namespace Advent\Shared\Input;

use Advent\Shared\Input\FileInput\FileSystem;
use Advent\Shared\Input\FileInput\SimpleFileSystem;

final readonly class FileInput implements Input
{
    public function __construct(
        private FileSystem $filesystem,
        private string     $filePath
    ) {
    }

    public static function fromLocal(string $filePath): self
    {
        return new self(new SimpleFileSystem(), $filePath);
    }

    public function lines(): \Iterator
    {
        return $this->filesystem->readLineByLine($this->filePath);
    }

    public function content(): string
    {
        return $this->filesystem->read($this->filePath);
    }
}
