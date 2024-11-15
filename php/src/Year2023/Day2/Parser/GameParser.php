<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2\Parser;

use Advent\Shared\Lexer\LexerInterface;
use Advent\Shared\Lexer\RuntimeException;
use Advent\Shared\Lexer\Tokens;
use Advent\Year2023\Day2\Model\Color;
use Advent\Year2023\Day2\Model\Cubes;
use Advent\Year2023\Day2\Model\CubesSet;
use Advent\Year2023\Day2\Model\Game;

final readonly class GameParser
{
    public function __construct(
        private LexerInterface $lexer
    ) {
    }

    public function parse(string $line): Game
    {
        $tokens = $this->lexer->tokenize($line);

        $gameId = $this->parseGameId($tokens);
        $cubesSets = [];

        while ($tokens->next()) {
            $cubesSets[] = $this->parseCubesSet($tokens);
        }

        return new Game($gameId, ...$cubesSets);
    }

    private function parseGameId(Tokens $tokens): int
    {
        $tokens->skipUntil(GameTokenType::GAME);

        $gameIdToken = $tokens->next();
        $gameIdToken->assertIsA(GameTokenType::NUMBER);

        return (int) $gameIdToken->value;
    }

    private function parseCubesSet(Tokens $tokens): CubesSet
    {
        $cubes = [];

        while ($tokens->hasMore() && $tokens->current()->isNotA(GameTokenType::SEMICOLON)) {
            $cubes[] = $this->parseCubes($tokens);
            $tokens->next();
        }

        return CubesSet::of(...$cubes);
    }

    private function parseCubes(Tokens $tokens): Cubes
    {
        $cubesAmountToken = $tokens->skipUntil(GameTokenType::NUMBER);

        $cubeColorToken = $tokens->next();
        $cubeColorToken->assertIsA(GameTokenType::COLOR);

        return new Cubes(
            (int) $cubesAmountToken->value,
            Color::from($cubeColorToken->value)
        );
    }
}
