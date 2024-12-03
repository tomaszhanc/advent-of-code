<?php

declare(strict_types=1);

namespace Advent\Year2024\Day3;

use Advent\Shared\Input\Input;
use Advent\Shared\Interpreter\Add;
use Advent\Year2024\Day3\Parser\ProgramMemoryParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private ProgramMemoryParser $parser
    ) {
    }

    public function sumAllMulOperations(Input $input): int
    {
        $expressions = $this->parser->parseAllMulExpressions($input->content());

        return new Add(...$expressions)->interpret();
    }

    public function sumAllEnabledMulOperations(Input $input): int
    {
        $expressions = $this->parser->parseOnlyEnabledMulExpressions($input->content());

        return new Add(...$expressions)->interpret();
    }
}
