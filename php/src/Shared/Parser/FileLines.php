<?php

declare(strict_types=1);

namespace Advent\Shared\Parser;

use Advent\Shared\Filesystem\Filesystem;

/**
 * @template T of object
 * @template-implements \IteratorAggregate<T>
 */
final readonly class FileLines implements \IteratorAggregate
{
    /**
     * @param LineParser<T> $lineParser
     */
    public function __construct(
        private LineParser $lineParser,
        private Filesystem $filesystem,
        private string $filePath
    ) {
    }

    /**
     * @return \Traversable<T>
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->filesystem->readLineByLine($this->filePath) as $lineNumber => $line) {
            yield $this->lineParser->parse($line, $lineNumber);
        }
    }
}
