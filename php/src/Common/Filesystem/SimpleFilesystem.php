<?php

declare(strict_types=1);

namespace AoC\Common\Filesystem;

use AoC\Common\Filesystem;

final readonly class SimpleFilesystem implements Filesystem
{
    public function readLineByLine(string $filePath): \Iterator
    {
        $file = fopen($filePath, "r");

        while (!feof($file)) {
            yield fgets($file);
        }

        fclose($file);
    }
}
