<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Shared\Lexer\Tokens;
use Advent\Year2023\Day8\Model\Node;
use Advent\Year2023\Day8\Model\Nodes;
use Advent\Year2023\Day8\Model\Direction;
use Advent\Year2023\Day8\Model\Instructions;
use Advent\Year2023\Day8\Model\Map;

final readonly class Parser
{
    public function parse(string $content): Map
    {
        $doubleNewLinePosition = strpos($content, "\n\n");
        $instructionsString = trim(substr($content, 0, $doubleNewLinePosition));
        $nodesString = trim(substr($content, $doubleNewLinePosition));

        return new Map(
            $this->parseInstructions($instructionsString),
            $this->parseNodes($nodesString)
        );
    }

    private function parseInstructions(string $line): Instructions
    {
        $tokens = (new Lexer(InstructionsType::class))->tokenize($line);
        $tokens->skipUntil(InstructionsType::MOVE);
        $moves = [];

        while ($tokens->hasMore()) {
            $moves[] = Direction::from($tokens->current()->value);
            $tokens->next();
        }

        return new Instructions(...$moves);
    }

    private function parseNodes(string $content): Nodes
    {
        $tokens = (new Lexer(MapType::class))->tokenize($content);
        $tokens->skipUntil(MapType::NODE);
        $nodes = [];

        while ($tokens->hasMore()) {
            $nodes[] = $this->parseNode($tokens);
            $tokens->skipUntil(MapType::NEW_LINE);
            $tokens->next();
        }

        return new Nodes(...$nodes);
    }

    private function parseNode(Tokens $tokens): Node
    {
        $nodeNameToken = $tokens->current();
        $nodeNameToken->assertIsA(MapType::NODE);

        $tokens->next();
        $tokens->current()->assertIsA(MapType::EQUALS_SIGN);
        $tokens->next();
        $leftNodeToken = $tokens->current();
        $leftNodeToken->assertIsA(MapType::NODE);

        $tokens->next();
        $rightNodeToken = $tokens->current();
        $rightNodeToken->assertIsA(MapType::NODE);

        return new Node(
            $nodeNameToken->value,
            $leftNodeToken->value,
            $rightNodeToken->value
        );
    }
}
