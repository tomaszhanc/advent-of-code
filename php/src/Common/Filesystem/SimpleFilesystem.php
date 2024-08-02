<?php

declare(strict_types=1);

namespace AoC\Common\Filesystem;

use AoC\Common\Filesystem;
use AoC\Common\RuntimeException;

final readonly class SimpleFilesystem implements Filesystem
{
    public function readLineByLine(string $filePath): \Iterator
    {
        $file = fopen($filePath, "r");

        if ($file === false) {
            throw RuntimeException::because('Could not open file %s', $filePath);
        }

        while (!feof($file)) {
            $line = fgets($file);

            if ($line === false) {
                throw RuntimeException::because('Could not read line from file %s', $filePath);
            }

            yield $line;
        }

        fclose($file);
    }
}
