<?php

declare(strict_types=1);

namespace Advent\Shared\Filesystem;

interface Filesystem
{
    /**
     * @return \Iterator<int, string>
     */
    public function readLineByLine(string $filePath): \Iterator;
}
