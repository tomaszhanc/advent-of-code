<?php

declare(strict_types=1);

namespace Advent\Shared\Input\FileInput;

use Advent\Shared\Input\RuntimeException;

final readonly class SimpleFileSystem implements FileSystem
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

    public function read(string $filePath): string
    {
        return file_get_contents($filePath);
    }
}
