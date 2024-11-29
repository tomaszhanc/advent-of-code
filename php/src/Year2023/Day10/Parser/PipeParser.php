<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Parser;

use Advent\Shared\Input\Input;
use Advent\Shared\Lexer\Lexer;
use Advent\Year2023\Day10\Model\Pipe;
use Advent\Year2023\Day10\Model\Pipes;
use Advent\Year2023\Day10\Model\PipeType as ModelPipeType;

final readonly class PipeParser
{
    public function parse(Input $input): Pipes
    {
        $pipes = [];

        foreach ($input->lines() as $lineNumber => $line) {
            $tokens = (new Lexer(PipeType::class))->tokenize($line);

            foreach ($tokens as $token) {
                $pipes[] = new Pipe(
                    $lineNumber,
                    $token->position,
                    ModelPipeType::fromString($token->value)
                );
            }
        }

        return new Pipes(...$pipes);
    }
}
