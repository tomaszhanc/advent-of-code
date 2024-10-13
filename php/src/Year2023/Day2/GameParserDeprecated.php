<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2;

use Advent\Year2023\Day2\GameParser\GameLexer;
use Advent\Year2023\Day2\GameParser\Type;
use Advent\Year2023\Day2\GamesRecord\Color;
use Advent\Year2023\Day2\GamesRecord\Cubes;
use Advent\Year2023\Day2\GamesRecord\CubesSet;
use Advent\Year2023\Day2\GamesRecord\Game;

final readonly class GameParserDeprecated
{
    private GameLexer $lexer;

    public function __construct()
    {
        $this->lexer = new GameLexer();
    }

    public function parse(string $line, int $lineNumber): Game
    {
        $this->lexer->setInput($line);

        return new Game($this->parseGameIdentifier(), ...$this->parseGameSets());
    }

    private function parseGameIdentifier(): int
    {
        $this->lexer->moveNext();

        if ($this->lookaheadIsNotA(Type::T_GAME)) {
            throw RuntimeException::invalidToken('Input should start from the game identifier.', $this->lexer->lookahead);
        }

        $this->lexer->moveNext();

        if ($this->lookaheadIsNotA(Type::T_NUMBER)) {
            throw RuntimeException::invalidToken('Game identifier should be a number.', $this->lexer->lookahead);
        }

        return (int) $this->lexer->lookahead->value;
    }

    /**
     * @return CubesSet[]
     */
    private function parseGameSets(): array
    {
        $gameSets = [];
        while ($this->lexer->lookahead !== null) {
            $gameSets[] = $this->parseGameSet();
        }

        return $gameSets;
    }

    private function parseGameSet(): CubesSet
    {
        $this->lexer->moveNext();

        $revealedCubes = [];
        while ($this->lookaheadIsNotA(Type::T_SEMICOLON)) {
            if ($this->lookaheadIsNotA(Type::T_NUMBER)) {
                throw RuntimeException::invalidToken('Quantity of cubes should be a number.', $this->lexer->lookahead);
            }

            $this->lexer->moveNext();

            if ($this->lookaheadIsNotA(Type::T_COLOR)) {
                throw RuntimeException::invalidToken('Unknown color.', $this->lexer->lookahead);
            }

            $revealedCubes[] = new Cubes(
                (int) $this->lexer->token->value ?? throw RuntimeException::unexpected('Lexer token should not be null'),
                Color::from($this->lexer->lookahead->value)
            );

            $this->lexer->moveNext();
        }

        return CubesSet::of(...$revealedCubes);
    }

    /**
     * @psalm-assert !null $this->lexer->lookahead
     */
    private function lookaheadIsNotA(Type $type): bool
    {
        return $this->lexer->lookahead !== null && !$this->lexer->lookahead->isA($type);
    }

}
