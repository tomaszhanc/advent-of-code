<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Common\Filesystem;
use AoC\Year2023\Day1\CalibrationDocument\Line;

/**
 * @template-implements \IteratorAggregate<Line>
 */
final readonly class LinesFromFile implements \IteratorAggregate
{
    public function __construct(
        private LineParser $lineParser,
        private Filesystem $filesystem,
        private string $filePath
    ) {
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->filesystem->readLineByLine($this->filePath) as $line) {
            yield $this->lineParser->parse($line);
        }
    }
}
