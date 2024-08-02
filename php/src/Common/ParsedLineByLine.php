<?php

declare(strict_types=1);

namespace AoC\Common;

/**
 * @template-covariant TValue
 * @template-implements \IteratorAggregate<TValue>
 */
final readonly class ParsedLineByLine implements \IteratorAggregate
{
    /**
     * @param LineParser|NumberedLineParser<TValue> $lineParser
     */
    public function __construct(
        private LineParser|NumberedLineParser $lineParser,
        private Filesystem $filesystem,
        private string $filePath
    ) {
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->filesystem->readLineByLine($this->filePath) as $lineNumber => $line) {
            yield $this->lineParser instanceof LineParser
                ? $this->lineParser->parse($line)
                : $this->lineParser->parse($lineNumber, $line);
        }
    }
}
