<?php

declare(strict_types=1);

namespace Advent\Year2023;

use Advent\Shared\Filesystem\Filesystem;
use Advent\Shared\Filesystem\LocalFile;
use Advent\Shared\Filesystem\SimpleFilesystem;
use Advent\Year2023\Day3\Model\PartNumbersFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicLexer;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;
use Advent\Year2023\Day3\PartNumbersEvaluator;

/** @see https://adventofcode.com/2023/day/3 */
final readonly class Day3
{
    public function __construct(
        private Filesystem $filesystem,
        private PartNumbersEvaluator $partNumbersEvaluator
    ) {
    }

    public static function create(): self
    {
        return new self(
            new SimpleFilesystem(),
            new PartNumbersEvaluator(
                new EngineSchematicParser(new EngineSchematicLexer()),
                new PartNumbersFactory()
            )
        );
    }

    public function partOne_sumAllPartNumbers(string $engineSchematicFilePath): int
    {
        return $this->partNumbersEvaluator->sumAllPartNumbers(
            new LocalFile($this->filesystem, $engineSchematicFilePath)
        );
    }
}
