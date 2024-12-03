<?php

declare(strict_types=1);

namespace Advent\Year2024\Day3\Parser;

use Advent\Shared\Interpreter\Mul;
use Advent\Shared\Lexer\Lexer;

final readonly class ProgramMemoryParser
{
    /** @return Mul[] */
    public function parseAllMulExpressions(string $input): array
    {
        $tokens = new Lexer(MemoryType::class)->tokenize($input);
        $expressions = [];

        while ($tokens->hasMore()) {
            $token = $tokens->skipUntil(MemoryType::MUL);
            if ($token === null) {
                break;
            }

            $expressions[] = $this->parseMul($token->value);
            $tokens->next();
        }

        return $expressions;
    }

    /** @return Mul[] */
    public function parseOnlyEnabledMulExpressions(string $input): array
    {
        $tokens = new Lexer(MemoryType::class)->tokenize($input);
        $expressions = [];

        while ($tokens->hasMore()) {
            if ($tokens->current()->type === MemoryType::MUL) {
                $expressions[] = $this->parseMul($tokens->current()->value);
            }

            if ($tokens->current()->type === MemoryType::DONT) {
                $tokens->skipUntil(MemoryType::DO);
            }

            $tokens->next();
        }

        return $expressions;
    }

    private function parseMul(string $mul): Mul
    {
        preg_match('/mul\((\d+),(\d+)\)/', $mul, $matches);

        return Mul::fromInt((int) $matches[1], (int) $matches[2]);
    }
}
