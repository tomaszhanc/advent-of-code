<?php

declare(strict_types=1);

namespace AoC\Common;

/**
 * @template-covariant TValue
 * @template-implements \IteratorAggregate<TValue>
 */
final readonly class ParseFromFile implements \IteratorAggregate
{
    /**
     * @param Parser<TValue> $parser
     */
    public function __construct(
        private Parser $parser,
        private Filesystem $filesystem,
        private string $filePath
    ) {
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->filesystem->readLineByLine($this->filePath) as $line) {
            yield $this->parser->parse($line);
        }
    }
}
