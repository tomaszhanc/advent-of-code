<?php

declare(strict_types=1);

namespace Advent\Year2023\Day4\Parser;

use Advent\Shared\Lexer\RuntimeException;
use Advent\Shared\Lexer\Tokens;
use Advent\Year2023\Day4\Model\Scratchcard;

final readonly class ScratchcardParser
{
    public function __construct(
        private ScratchcardLexer $lexer
    ) {
    }

    public function parse(string $line): Scratchcard
    {
        $tokens = $this->lexer->tokenize($line);

        $cardId = $this->parseCardId($tokens);

        $tokens->next();
        $winningNumbers = $this->parseWinningNumbers($tokens);

        $tokens->next();
        $scratchedNumbers = $this->parseScratchedNumbers($tokens);

        return new Scratchcard($cardId, $winningNumbers, $scratchedNumbers);
    }

    private function parseCardId(Tokens $tokens): int
    {
        $tokens->skipUntil(ScratchcardType::CARD);

        $cardIdToken = $tokens->next();
        if ($cardIdToken->isNotA(ScratchcardType::NUMBER)) {
            throw RuntimeException::unexpectedToken(ScratchcardType::NUMBER, $cardIdToken->type);
        }

        return (int) $cardIdToken->value;
    }

    private function parseWinningNumbers(Tokens $tokens): array
    {
        $winningNumbers = [];

        while ($tokens->current()->isNotA(ScratchcardType::BAR)) {
            $winningNumbers[] = (int) $tokens->current()->value;
            $tokens->next();
        }

        return $winningNumbers;
    }

    private function parseScratchedNumbers(Tokens $tokens): array
    {
        $scratchedNumbers = [];

        while ($tokens->hasMore()) {
            $scratchedNumbers[] = (int) $tokens->current()->value;
            $tokens->next();
        }

        return $scratchedNumbers;
    }
}
