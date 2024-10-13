<?php

declare(strict_types=1);

namespace Advent\Shared\Filesystem;

final readonly class LocalFile implements File
{
    public function __construct(
        private Filesystem $filesystem,
        private string $filePath
    ) {
    }

    public function lines(): iterable
    {
        return $this->filesystem->readLineByLine($this->filePath);
    }
}
