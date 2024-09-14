<?php

declare(strict_types=1);

namespace Advent\Shared\Filesystem;

interface Filesystem
{
    /**
     * @return \Iterator<string>
     */
    public function readLineByLine(string $filePath): \Iterator;
}
