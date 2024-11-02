<?php

declare(strict_types=1);

namespace Advent\Year2023\Day6\Parser;

use Advent\Shared\Lexer\LexerInterface;
use Advent\Shared\Lexer\Tokens;
use Advent\Year2023\Day6\Model\Race;
use Advent\Year2023\Day6\Model\RaceLog;

final readonly class RaceLogParser
{
    public function __construct(
        private LexerInterface $lexer
    ) {
    }

    public function parse(string $line): RaceLog
    {
        $tokens = $this->lexer->tokenize($line);

        $tokens->skipUntil(RaceLogType::TIME);
        $tokens->next();
        $allRacesTimes = $this->parseNumbers($tokens);

        $tokens->skipUntil(RaceLogType::DISTANCE);
        $tokens->next();
        $allRacesDistances = $this->parseNumbers($tokens);

        $races = [];
        for ($i = 0; $i < count($allRacesTimes); $i++) {
            $races[] = new Race(
                time: $allRacesTimes[$i],
                recordDistance: $allRacesDistances[$i]
            );
        }

        return new RaceLog(...$races);
    }

    private function parseNumbers(Tokens $tokens): array
    {
        $numbers = [];

        while ($tokens->hasMore() && $tokens->current()->isA(RaceLogType::NUMBER)) {
            $numbers[] = (int) $tokens->current()->value;
            $tokens->next();
        }

        return $numbers;
    }
}
