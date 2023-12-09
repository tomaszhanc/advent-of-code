<?php

declare(strict_types=1);

namespace AoC\Common;

interface Filesystem
{
    /**
     * @return \Iterator<string>
     */
    public function readLineByLine(string $filePath): \Iterator;
}
